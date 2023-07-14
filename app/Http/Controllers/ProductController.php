<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\TempImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('admin.products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'nullable',
            'detail' => 'required',
            'price' => 'required|numeric',
            'reduced_price' => 'nullable|numeric',
            'image_product' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'hot_deals' => 'nullable|boolean',
            'status' => 'nullable|boolean',
        ]);

        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
            'reduced_price' => 'nullable|numeric',
        ]);

        $validator->after(function ($validator) use ($request) {
            $price = $request->input('price');
            $reducedPrice = $request->input('reduced_price');

            if ($reducedPrice >= $price) {
                $validator->errors()->add('reduced_price', 'Giá giảm phải nhỏ hơn giá gốc.');
            }
        });

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // Lưu trữ ảnh sản phẩm và lấy đường dẫn
        $imagePath = $request->file('image_product')->store('images', 'public');

        $product = new Product([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'detail' => $request->input('detail'),
            'price' => $request->input('price'),
            'reduced_price' => $request->input('reduced_price'),
            'image_product' => $imagePath,
            'category_id' => $request->input('category_id'),
            'hot_deals' => $request->has('hot_deals'),
            'status' => $request->has('status'),
        ]);
        $product->user_id = auth()->id();
        $product->save();
        if (!empty($request->image_id)) {
            $caption = $request->caption;

            foreach ($request->image_id as $key => $imageId) {

                $tempImage = TempImage::find($imageId);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $productImage = new ProductImage;
                $productImage->name = 'NULL';
                $productImage->product_id = $product->id;
                $productImage->caption = $caption[$key];
                $productImage->save();

                $newImageName = $productImage->id . '.' . $ext;
                $productImage->name = $newImageName;
                $productImage->save();

                // First Thumbnail
                $sourcePath = public_path('uploads/temp/' . $tempImage->name);
                $destPath = public_path('uploads/products/small/' . $newImageName);
                $img = Image::make($sourcePath);
                $img->fit(350, 300);
                $img->save($destPath);

                // Second Thumbnail
                $sourcePath = public_path('uploads/temp/' . $tempImage->name);
                $destPath = public_path('uploads/products/large/' . $newImageName);
                $img = Image::make($sourcePath);
                $img->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($destPath);
            }
        }
        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }


    public function update($product_id, Request $request)
    {

        $product = Product::find($product_id);
        $request->validate([
            'name' => 'required',
            'slug' => 'nullable',
            'detail' => 'required',
            'price' => 'required|numeric',
            'reduced_price' => 'nullable|numeric',
            'image_product' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'status' => 'nullable|boolean',
        ]);

        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
            'reduced_price' => 'required|numeric',
        ]);

        $validator->after(function ($validator) use ($request) {
            $price = $request->input('price');
            $reducedPrice = $request->input('reduced_price');

            if ($reducedPrice >= $price) {
                $validator->errors()->add('reduced_price', 'Giá giảm phải nhỏ hơn giá gốc.');
            }
        });

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        if ($request->hasFile('image_product')) {
            if ($product->image_product) {
                $oldImagePath = $product->image_product;
                Storage::delete($oldImagePath);
            }

            $imagePath = $request->file('image_product')->store('images', 'public');
            $product->image_product = $imagePath;
        }


        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->detail = $request->input('detail');
        $product->price = $request->input('price');
        $product->reduced_price = $request->input('reduced_price');
        $product->category_id = $request->input('category_id');
        $product->hot_deals = $request->input('hot_deals');
        $product->status = $request->input('status');
        $product->user_id = auth()->id();
        $product->save();

        if (!empty($request->image_id)) {
            $caption = $request->caption;
            foreach ($request->image_id as $key => $imageId) {

                $productImage = ProductImage::find($imageId);
                $productImage->caption = $caption[$key];
                $productImage->save();
            }
        }

        $request->session()->flash('success', 'Product updated successfully.');

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }






    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product): View
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id, Request $request)
    {
        $product = Product::find($product_id);
        if ($product == null) {
            return redirect()->route('products.index');
        }
        $productImages = ProductImage::where('product_id', $product->id)->get();
        $data['product'] = $product;
        $data['productImages'] = $productImages;
        return view('admin.products.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image_product) {
            $imagePath = parse_url($product->image_product)['path'];
            Storage::delete($imagePath);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
    public function trangthai_choose(Request $request)
    {
        $data = $request->all();
        $product = Product::find($data['id']);
        $product->status = $data['trangthai_val'];
        $product->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $product->save();
    }
     public function hotDeal_choose(Request $request)
    {
        $data = $request->all();
        $product = Product::find($data['product_id']);
        $product->hot_deals = $data['hotDeal_val'];
        $product->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $product->save();
    }
}
