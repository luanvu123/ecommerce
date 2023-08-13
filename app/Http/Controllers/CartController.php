<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $carts = Cart::where('customer_id', $customer->id)->get();
        $carts->each(function ($cart) {
            $product = $cart->product;
            if ($product->reduced_price !== null) {
                $price = $product->reduced_price;
            } else {
                $price = $product->price;
            }
            $cart->subtotal = $cart->quantity * $price;
        });
        $total = $carts->sum('subtotal');
        $cartTotalQuantity = $carts->sum('quantity');
        $couponDiscount = 0;
        $totalAfterCoupon = $total;

        return view('pages.cart', compact('carts', 'total', 'couponDiscount', 'cartTotalQuantity', 'totalAfterCoupon'));
    }
    public function addToCart(Request $request, $product_id)
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $quantity = $request->input('quantity', 1);
        $cart = Cart::where('customer_id', $customer_id)
            ->where('product_id', $product_id)
            ->first();

        if ($cart) {
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            $product = Product::findOrFail($product_id);
            if ($product->reduced_price !== null) {
                $price = $product->reduced_price;
            } else {
                $price = $product->price;
            }
            Cart::create([
                'customer_id' => $customer_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function clearCart()
    {
        $customer_id = Auth::guard('customer')->user()->id;
        Cart::where('customer_id', $customer_id)->delete();
        return redirect()->back()->with('success', 'Shopping Cart cleared.');
    }

    public function updateCart(Request $request)
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $cartItems = $request->input('cart');

        foreach ($cartItems as $productId => $quantity) {
            $cart = Cart::where('customer_id', $customer_id)
                ->where('product_id', $productId)
                ->first();

            if ($cart) {
                $cart->quantity = $quantity;
                $cart->save();
            }
        }

        return redirect()->back()->with('success', 'Shopping Cart updated.');
    }
    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');
        $customerId = Auth::guard('customer')->user()->id;
        Cart::where('customer_id', $customerId)->where('product_id', $productId)->delete();

        return redirect()->route('cart')->with('success', 'Product removed from cart successfully.');
    }
    public function updateQuantity(Request $request)
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $cartItems = $request->input('cart');

        foreach ($cartItems as $productId => $quantity) {
            $cart = Cart::where('customer_id', $customer_id)
                ->where('product_id', $productId)
                ->first();

            if ($cart) {
                $cart->quantity = $quantity;
                $cart->save();
            }
        }
        return redirect()->back();
    }
    public function applyCoupon(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $carts = Cart::where('customer_id', $customer->id)->get();
        $carts->each(function ($cart) {
            $product = $cart->product;
            if ($product->reduced_price !== null) {
                $price = $product->reduced_price;
            } else {
                $price = $product->price;
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
        session()->flash('coupon_message', $message);

        return view('pages.cart', compact('carts', 'total', 'cartTotalQuantity', 'couponDiscount', 'totalAfterCoupon'));
    }
}
