<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer', 'coupon', 'shipping')->orderByDesc('created_at')->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Lấy thông tin đơn hàng dựa trên $id
        $order = Order::findOrFail($id);

        // Lấy danh sách chi tiết đơn hàng (order_details) của đơn hàng này
        $orderDetails = OrderDetail::with('product', 'sku')->where('order_id', $order->id)->get();

        // Trả về view hiển thị chi tiết đơn hàng
        return view('admin.orders.show', compact('order', 'orderDetails'));
    }
    public function order_choose(Request $request)
    {
        $data = $request->all();
        $order = Order::find($data['id']);
        $order->status = $data['trangthai_val'];
        $order->updated_at = now();
        $order->save();

        return response()->json(['success' => true]);
    }
}
