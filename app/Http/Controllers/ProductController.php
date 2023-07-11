<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

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
            'image_product2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_product3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_product4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_product5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
        $imagePath2 = $request->file('image_product2') ? $request->file('image_product2')->store('images', 'public') : null;
        $imagePath3 = $request->file('image_product3') ? $request->file('image_product3')->store('images', 'public') : null;
        $imagePath4 = $request->file('image_product4') ? $request->file('image_product4')->store('images', 'public') : null;
        $imagePath5 = $request->file('image_product5') ? $request->file('image_product5')->store('images', 'public') : null;

        $product = new Product([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'detail' => $request->input('detail'),
            'price' => $request->input('price'),
            'reduced_price' => $request->input('reduced_price'),
            'image_product' => $imagePath,
            'image_product2' => $imagePath2,
            'image_product3' => $imagePath3,
            'image_product4' => $imagePath4,
            'image_product5' => $imagePath5,
            'category_id' => $request->input('category_id'),
            'hot_deals' => $request->has('hot_deals'),
            'status' => $request->has('status'),
        ]);

        $product->user_id = auth()->id();
        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }


    public function update(Request $request, Product $product): RedirectResponse
    {
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
        $product->image_product2 = $request->file('image_product2') ? $request->file('image_product2')->store('images', 'public') : null;
        $product->image_product3 = $request->file('image_product3') ? $request->file('image_product3')->store('images', 'public') : null;
        $product->image_product4 = $request->file('image_product4') ? $request->file('image_product4')->store('images', 'public') : null;
        $product->image_product5 = $request->file('image_product5') ? $request->file('image_product5')->store('images', 'public') : null;
        $product->status = $request->input('status');
        $product->user_id = auth()->id();
        $product->save();

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
    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
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
}
