<?php

namespace App\Http\Controllers;

use App\Models\AttributeOption;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkuController extends Controller
{
     public function create_sku($product_id)
    {
         $product = Product::findOrFail($product_id);
        $attributeOptions = AttributeOption::all(); // Lấy danh sách tất cả các tùy chọn thuộc tính
        return view('admin.skus.create', compact('product', 'attributeOptions'));
    }

  public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'code' => 'required|unique:skus',
            'price' => 'required|integer|min:0',
            'reduced_price' => 'nullable|integer|min:0',
            'stock' => 'required|integer|min:0',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
            'attribute_options' => 'array', // Yêu cầu kiểu dữ liệu mảng
        ]);

        $product = Product::findOrFail($request->input('product_id'));

        $skuData = [
            'product_id' => $product->id,
            'code' => $request->input('code'),
            'price' => $request->input('price'),
            'reduced_price' => $request->input('reduced_price'),
            'stock' => $request->input('stock'),
            'status' => $request->input('status'),
        ];

        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('sku_images', 'public');
            $skuData['images'] = $imagePath;
        }

        $sku = Sku::create($skuData);

        // Lưu mối quan hệ với tùy chọn thuộc tính
        $attributeOptions = $request->input('attribute_options', []);
        $sku->attributeOptions()->sync($attributeOptions);

        return redirect()->route('products.index')->with('success', 'Sku created successfully.');
    }
   public function index()
    {
        $skus = Sku::with(['product', 'attributeOptions.attribute'])->get();
        return view('admin.skus.index', compact('skus'));
    }

  public function destroy($id)
    {
        $sku = Sku::findOrFail($id);

        // Xóa hình ảnh nếu tồn tại
        if ($sku->images) {
            Storage::delete('public/' . $sku->images);
        }

        $sku->delete();

        return redirect()->route('skus.index')->with('success', 'Sku deleted successfully.');
    }
     public function edit($id)
    {
        $sku = Sku::findOrFail($id);
        $attributeOptions = AttributeOption::all(); // Lấy tất cả tùy chọn thuộc tính
        $selectedOptions = $sku->attributeOptions->pluck('id')->toArray(); // Lấy các tùy chọn đã chọn của Sku
        return view('admin.skus.edit', compact('sku', 'attributeOptions', 'selectedOptions'));
    }
      public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:skus,code,' . $id,
            'price' => 'required|integer|min:0',
             'reduced_price' => 'nullable|integer|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:0,1',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);

        $sku = Sku::findOrFail($id);

        $skuData = [
            'code' => $request->input('code'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'status' => $request->input('status'),
        ];

        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('sku_images', 'public');
            $skuData['images'] = $imagePath;
        }

        $sku->update($skuData);

        $sku->attributeOptions()->sync($request->input('attribute_options')); // Cập nhật lại quan hệ

        return redirect()->route('skus.index')->with('success', 'Sku updated successfully.');
    }

   public function show($id)
    {
        $sku = Sku::with('product', 'attributeOptions.attribute')->findOrFail($id);
        return view('admin.skus.show', compact('sku'));
    }

}
