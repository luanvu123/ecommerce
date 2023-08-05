<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\OutgoingProduct;
use Illuminate\Http\Request;
use App\Models\Product;

class OutgoingProductController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('admin.outgoing_products.create', compact('products'));
    }
 public function index()
    {
        $outgoingProducts = OutgoingProduct::with('product')->orderBy('id', 'DESC')->get();
        return view('admin.outgoing_products.index', compact('outgoingProducts'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        $inventory = Inventory::findOrFail($validatedData['product_id']);
        if ($inventory->quantity < $validatedData['quantity']) {
            return redirect()->back()->with('error', 'Không đủ số lượng sản phẩm để xuất kho.');
        }

        $outgoingProduct = new OutgoingProduct();
        $outgoingProduct->product_id = $validatedData['product_id'];
        $outgoingProduct->quantity = $validatedData['quantity'];
        $outgoingProduct->note = $validatedData['note'];
        $outgoingProduct->user_id = auth()->user()->id;
        $outgoingProduct->save();

        $inventory->save();

        return redirect()->route('outgoing_products.index')->with('success', 'Xuất kho thành công.');
    }
      public function delete($id)
    {
        $outgoingProduct = OutgoingProduct::findOrFail($id);
        $outgoingProduct->delete();

        return redirect()->route('outgoing_products.index')->with('success', 'Xóa kho thành công.');
    }
      public function outgoing_create_product($product_id)
    {
        $product = Product::findOrFail($product_id);
         $inventory = Inventory::findOrFail($product_id);
        if ($inventory->quantity < $product->quantity) {
            return redirect()->back()->with('error', 'Không đủ số lượng sản phẩm để xuất kho.');
        }
        return view('admin.outgoing_products.show', compact('product'));
    }
}

