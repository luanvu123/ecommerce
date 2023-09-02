<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\OutgoingProduct;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use PDF;

class OutgoingProductController extends Controller
{
    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::where('status', 1)->get();
        return view('admin.outgoing_products.create', compact('products', 'suppliers'));
    }
    public function index()
    {
        $outgoingProducts = OutgoingProduct::with('product', 'user', 'supplier')->orderBy('id', 'DESC')->get();
        return view('admin.outgoing_products.index', compact('outgoingProducts'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'note' => 'nullable|string',
        'supplier_id' => 'required|exists:suppliers,id',
        'price_type' => 'required|in:product_price,custom_price', // Thêm luật kiểm tra cho trường price_type
    ]);

    $product = Product::findOrFail($validatedData['product_id']);

    if (!$product->inventory || $product->inventory->quantity === null || $product->inventory->quantity < $validatedData['quantity']) {
        return redirect()->back()->with('error', 'Không đủ số lượng sản phẩm để xuất kho.');
    }

    $outgoingProduct = new OutgoingProduct();
    $outgoingProduct->product_id = $validatedData['product_id'];
    $outgoingProduct->quantity = $validatedData['quantity'];
    $outgoingProduct->note = $validatedData['note'];

    if ($validatedData['price_type'] === 'custom_price') {
        // Nếu giá khác được chọn, lấy giá từ trường 'custom_price' (sử dụng tùy chọn ở biểu mẫu)
        $customPrice = $request->input('custom_price');
        $outgoingProduct->price = $customPrice;
        $outgoingProduct->total_amount = $customPrice * $validatedData['quantity'];
    } else {
        // Nếu giá sản phẩm được chọn, lấy giá từ sản phẩm
        if ($product->reduced_price !== null) {
            $outgoingProduct->price = $product->reduced_price;
        } else {
            $outgoingProduct->price = $product->price;
        }
        $outgoingProduct->total_amount = $outgoingProduct->price * $validatedData['quantity'];
    }

    $outgoingProduct->supplier_id = $validatedData['supplier_id'];
    $outgoingProduct->user_id = auth()->user()->id;
    $outgoingProduct->save();
    return redirect()->route('outgoing_products.index')->with('success', 'Xuất kho thành công.');
}

    public function destroy($id)
    {
        $outgoingProduct = OutgoingProduct::findOrFail($id);
        $outgoingProduct->delete();
        return redirect()->route('outgoing_products.index')->with('success', 'Xóa kho thành công.');
    }
    public function outgoing_create_product($product_id)
    {
        $product = Product::findOrFail($product_id);
        $suppliers = Supplier::where('status', 1)->get();
        return view('admin.outgoing_products.create_product', compact('product', 'suppliers'));
    }
    public function show($id)
    {
        $outgoingProduct = OutgoingProduct::with('product', 'user', 'supplier')->findOrFail($id);
        return view('admin.outgoing_products.show', compact('outgoingProduct'));
    }
    public function generatePDF($id)
    {
        $outgoingProduct = OutgoingProduct::with('product', 'user', 'supplier')->findOrFail($id);

        $pdf = PDF::loadView('admin.outgoing_products.pdf', compact('outgoingProduct'));

        return $pdf->download('outgoing_product_' . $outgoingProduct->id . '.pdf');
    }
}
