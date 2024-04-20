<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Sku;
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

        return view('pages.cart', compact('carts', 'total', 'couponDiscount', 'cartTotalQuantity', 'totalAfterCoupon'));
    }

    public function addToCart(Request $request, $product_id)
    {
        $customer_id = Auth::guard('customer')->user()->id;
        $quantity = $request->input('quantity', 1);
        $sku_id = $request->input('sku_id'); // Lấy ID của sku từ request

        // Kiểm tra xem sản phẩm đã được thêm vào giỏ hàng chưa
        $cart = Cart::where('customer_id', $customer_id)
            ->where('product_id', $product_id)
            ->where('sku_id', $sku_id)
            ->first();

        if ($cart) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, tạo một mục mới
            $product = Product::findOrFail($product_id);
            if ($product->skus->isNotEmpty() && $sku_id) {
                // Nếu sản phẩm có sku và sku được chọn, lấy giá từ sku
                $sku = Sku::findOrFail($sku_id); // Tìm SKU dựa trên sku_id
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

            Cart::create([
                'customer_id' => $customer_id,
                'product_id' => $product_id,
                'sku_id' => $sku_id,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }
        return redirect()->route('cart')->with('success', 'Product added to cart.');
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
}
