<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $carts = Cart::where('customer_id', $customer->id)->get();
        $shippings = Shipping::where('status', 1)->get();

        $carts->each(function ($cart) {
            $product = $cart->product;
            if ($product->skus->isNotEmpty() && $cart->sku_id) {
                // Nếu sản phẩm có sku và sku đã được chọn, tính toán giá từ sku
                $sku = Sku::findOrFail($cart->sku_id);
                if ($sku->reduced_price !== null) {
                    $price = $sku->reduced_price;
                } else {
                    $price = $sku->price;
                }
            } else {
                if ($product->reduced_price !== null) {
                    $price = $product->reduced_price;
                } else {
                    $price = $product->price;
                }
            }
            $cart->subtotal = $cart->quantity * $price;
        });

        $total = $carts->sum('subtotal');
        $cartTotalQuantity = $carts->sum('quantity');
        $couponDiscount = 0;
        $totalAfterCoupon = $total;

        return view('pages.checkout', compact('customer', 'carts', 'total', 'couponDiscount', 'cartTotalQuantity', 'totalAfterCoupon', 'shippings'));
    }

    public function applyCoupon(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $carts = Cart::where('customer_id', $customer->id)->get();
        $shippings = Shipping::where('status', 1)->get();
        $carts->each(function ($cart) {
            $product = $cart->product;
            if ($product->skus->isNotEmpty() && $cart->sku_id) {
                // Nếu sản phẩm có sku và sku đã được chọn, tính toán giá từ sku
                $sku = Sku::findOrFail($cart->sku_id);
                if ($sku->reduced_price !== null) {
                    $price = $sku->reduced_price;
                } else {
                    $price = $sku->price;
                }
            } else {
                // Nếu sản phẩm không có sku, sử dụng giá của sản phẩm
                if ($product->reduced_price !== null) {
                    $price = $product->reduced_price;
                } else {
                    $price = $product->price;
                }
            }
            $cart->subtotal = $cart->quantity * $price;
        });

        $total = $carts->sum('subtotal');
        $cartTotalQuantity = $carts->sum('quantity');

        $couponCode = $request->input('coupon_code');
        $couponDiscount = 0;
        $message = '';

        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->where('status', 1)->where('expires_at', '>=', now())->first();

            if ($coupon) {
                $couponDiscount = ($coupon->type === 'percent') ? $total * ($coupon->value / 100) : $coupon->value;
                $message = 'Coupon applied successfully!';
            } else {
                $message = 'Invalid coupon code. Please try again.';
                return redirect()->back()->with('coupon_error', $message);
            }
        }


        // Sau khi xác định được giảm giá từ mã coupon, lưu coupon_id vào session
        $coupon = Coupon::where('code', $couponCode)->where('status', 1)->where('expires_at', '>=', now())->first();
        if ($coupon) {
            session(['coupon_id' => $coupon->id]);
        }
        $totalAfterCoupon = $total - $couponDiscount;
        if ($request->has('shipping')) {

            $shippingPrice = $request->input('shipping');
            $totalAfterCoupon += $shippingPrice;
        }
        session()->flash('coupon_message', $message);
        return view('pages.checkout', compact('customer', 'carts', 'total', 'cartTotalQuantity', 'couponDiscount', 'totalAfterCoupon', 'shippings'));
    }


    public function checkoutSubmit(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $carts = Cart::where('customer_id', $customer->id)->get();
        $couponId = session('coupon_id');
         $shippingPrice = $request->input('shipping_price');
        // Tạo một đối tượng Order
        $order = new Order();
        $order->customer_id = $customer->id;
        $order->recipient_name = $request->input('fullname_customer');
        $order->recipient_phone = $request->input('phone_number_customer');
        $order->recipient_address = $request->input('address_customer');
        $order->recipient_email = $request->input('email');
        $order->total_price = $request->input('totalAfterCoupon') + $shippingPrice;
        $order->status = 'pending';
        $order->payment_method = 'cash_on_delivery';
        $order->shipping_id = $request->input('shipping_id');
        dd($order->total_price);
        $order->coupon_id = $couponId;
        $order->save();

        // Lưu chi tiết đơn hàng
        foreach ($carts as $cart) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cart->product_id;
            $orderDetail->quantity = $cart->quantity;
            $orderDetail->sku_id = $cart->sku_id;

            if ($cart->sku_id) {
                $sku = Sku::findOrFail($cart->sku_id);
                $orderDetail->price_detail = $sku->reduced_price ?? $sku->price;
            } else {
                $orderDetail->price_detail = $cart->product->reduced_price ?? $cart->product->price;
            }
            $orderDetail->subtotal_detail = $cart->quantity * $orderDetail->price_detail;

            $orderDetail->save();
        }

        // Xóa các sản phẩm trong giỏ hàng sau khi đã đặt hàng thành công
        $carts->each->delete();
        // Redirect hoặc hiển thị thông báo thành công
        return redirect()->route('order.success')->with('success_message', 'Đơn hàng đã được đặt thành công!');
    }
}
