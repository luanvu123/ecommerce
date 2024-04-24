<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
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
        $couponDiscount = 0;
        $totalAfterCoupon = $total;

        return view('pages.checkout', compact('customer','carts', 'total', 'couponDiscount', 'cartTotalQuantity', 'totalAfterCoupon', 'shippings'));
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


    $totalAfterCoupon = $total - $couponDiscount;
    if ($request->has('shipping')) {

        $shippingPrice = $request->input('shipping');
        $totalAfterCoupon += $shippingPrice;
    }
    session()->flash('coupon_message', $message);
    return view('pages.checkout', compact('carts', 'total', 'cartTotalQuantity', 'couponDiscount', 'totalAfterCoupon', 'shippings'));
}

}
