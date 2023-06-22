<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(5);
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
            'detail' => 'required',
            'price' => 'required',
            'image_product' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Lưu trữ ảnh sản phẩm và lấy đường dẫn
        $imagePath = $request->file('image_product')->store('images', 'public');

        $product = new Product([
            'name' => $request->input('name'),
            'detail' => $request->input('detail'),
            'price' => $request->input('price'),
            'image_product' => $imagePath,
            'category_id' => $request->input('category_id'),
        ]);

        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }


    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required',
            'image_product' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image_product')) {
            // Xóa ảnh cũ nếu có
            if ($product->image_product) {
                $oldImagePath = $product->image_product;
                Storage::delete($oldImagePath);
            }

            // Lưu trữ ảnh mới và lấy đường dẫn
            $imagePath = $request->file('image_product')->store('images', 'public');
            $product->image_product = $imagePath;
        }

        $product->name = $request->input('name');
        $product->detail = $request->input('detail');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
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
