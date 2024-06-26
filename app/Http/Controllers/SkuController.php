<?php

namespace App\Http\Controllers;

use App\Models\AttributeOption;
use App\Models\Product;
use App\Models\Sku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Unique;

class SkuController extends Controller
{
    public function create_sku($product_id)
    {
        $product = Product::findOrFail($product_id);
        $attributeOptions = AttributeOption::all();
        return view('admin.skus.create', compact('product', 'attributeOptions'));
    }

    public function show_product_sku($product_id)
    {
        $product = Product::findOrFail($product_id);
        $skus = Sku::with(['product', 'attributeOptions.attribute'])->where('product_id', $product->id)->get();
        return view('admin.skus.show_product_sku', compact('product', 'skus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'price' => 'required|integer|min:0',
            'reduced_price' => 'nullable|integer|min:0',
            'stock' => 'required|integer|min:0',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
            'attribute_options' => 'array',
        ]);
        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('sku_images', 'public');
            $skuData['images'] = $imagePath;
        }


        $attributeOptions = $request->all();
        unset(
            $attributeOptions['_token'],
            $attributeOptions['product_id'],
            $attributeOptions['code'],
            $attributeOptions['price'],
            $attributeOptions['reduced_price'],
            $attributeOptions['stock'],
            $attributeOptions['images'],
            $attributeOptions['status']
        );
        $attributeOptions = array_values($attributeOptions);
        $product = Product::findOrFail($request->input('product_id'));
        $code = $product->id;
        foreach ($attributeOptions as $optionId) {
            $attributeOption = AttributeOption::findOrFail($optionId);
            $code .= '_' . $attributeOption->id;
        }
        // dd($code);
        $skuData = [
            'product_id' => $product->id,
            'code' => $code,
            'price' => $request->input('price'),
            'reduced_price' => $request->input('reduced_price'),
            'stock' => $request->input('stock'),
            'status' => $request->input('status'),
        ];
        $sku = Sku::create($skuData);
        $sku->attributeOptions()->attach($attributeOptions);

        return redirect()->route('show.skus.product', ['product_id' => $product->id])->with('success', 'Sku created successfully.');
    }
    public function index()
    {
        $skus = Sku::with(['product', 'attributeOptions.attribute'])->get();
        return view('admin.skus.index', compact('skus'));
    }

    public function destroy($id)
    {
        $sku = Sku::findOrFail($id);
        $sku->attributeOptions()->detach();
        // Xóa hình ảnh nếu tồn tại
        if ($sku->images) {
            Storage::delete('public/' . $sku->images);
        }

        $sku->delete();

        return redirect()->back()->with('success', 'Sku deleted successfully.');

    }
    public function edit($id)
    {
        $sku = Sku::findOrFail($id);
        $attributeOptions = AttributeOption::all();

        $selectedOptions = [];
        foreach ($sku->attributeOptions as $option) {
            $attributeName = $option->attribute->name;
            $selectedOptions[$attributeName][] = $option->id;
        }

        return view('admin.skus.edit', compact('sku', 'attributeOptions', 'selectedOptions'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|integer|min:0',
            'reduced_price' => 'nullable|integer|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:0,1',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);

        $sku = Sku::findOrFail($id);

        $skuData = [
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'reduced_price' => $request->input('reduced_price'),
            'status' => $request->input('status'),
        ];

        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('sku_images', 'public');
            $skuData['images'] = $imagePath;
        }

        $sku->update($skuData);

        $selectedOptions = $request->input('attribute_options', []);
        $sku->attributeOptions()->sync($selectedOptions);

        return redirect()->back()->with('success', 'Sku updated successfully.');
    }

    public function show($id)
    {
        $sku = Sku::with('product', 'attributeOptions.attribute')->findOrFail($id);
        return view('admin.skus.show', compact('sku'));
    }
      public function sku_choose(Request $request)
    {
        $data = $request->all();
        $sku = Sku::find($data['id']);
        $sku->status = $data['trangthai_val'];
        $sku->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $sku->save();
    }
}
