<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
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
            $price = $product->reduced_price;
            Cart::create([
                'customer_id' => $customer_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart.');
    }
    public function updateQuantity(Request $request)
    {
        $customerId = Auth::guard('customer')->user()->id;
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cart = Cart::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->first();

        if ($cart) {
            $cart->quantity = $quantity;
            $cart->save();
        }

        return response()->json(['message' => 'Quantity updated successfully.']);
    }
}
