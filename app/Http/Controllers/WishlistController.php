<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
class WishlistController extends Controller
{
     public function index()
    {
        $customerId = Auth::guard('customer')->user()->id;
        $wishlistItems = Wishlist::where('customer_id', $customerId)->with('product', 'product.inventory')->get();
        return view('pages.wishlist', compact('wishlistItems'));
    }
      public function addToWishlist($product_id)
    {
        $customer_id =  Auth::guard('customer')->user()->id;
        $wishlist = Wishlist::where('customer_id', $customer_id)->where('product_id', $product_id)->first();
        if (!$wishlist) {
            $wishlist = new Wishlist();
            $wishlist->customer_id = $customer_id;
            $wishlist->product_id = $product_id;
            $wishlist->save();
        }
        return redirect()->back()->with('success', 'Product added to wishlist.');
    }
     public function removeFromWishlist(Request $request)
    {
        $productId = $request->input('product_id');
        $customerId = Auth::guard('customer')->user()->id;
        Wishlist::where('customer_id', $customerId)->where('product_id', $productId)->delete();

        return redirect()->route('wishlist')->with('success', 'Product removed from wishlist successfully.');
    }
}
