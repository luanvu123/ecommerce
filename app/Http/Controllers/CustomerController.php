<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index()
    {
        // Lấy danh sách tất cả khách hàng
        $customers = Customer::all();

        return view('admin.customers.index', compact('customers'));
    }
      public function showOrders($customerId)
    {
        // Lấy thông tin khách hàng
        $customer = Customer::findOrFail($customerId);

        // Lấy danh sách đơn hàng của khách hàng
        $orders = Order::where('customer_id', $customerId)->orderBy('created_at', 'desc')->get();

        return view('admin.customers.show_orders', compact('customer', 'orders'));
    }
     public function customer_choose(Request $request)
    {
        $data = $request->all();
        $customer = Customer::find($data['id']);
        $customer->status = $data['trangthai_val'];
        $customer->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $customer->save();
    }
}

