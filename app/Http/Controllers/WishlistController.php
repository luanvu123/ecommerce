<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\OutgoingProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
class WishlistController extends Controller
{
     public function index()
    {
        // Assuming you already have the $items variable for wishlist items
        $products = Product::all(); // Fetch all products (adjust this based on your logic)
        $productIds = $products->pluck('id')->toArray();
        $totalQuantities = Inventory::whereIn('product_id', $productIds)
            ->groupBy('product_id')
            ->selectRaw('product_id, SUM(quantity) as total_quantity')
            ->pluck('total_quantity', 'product_id');

        // Calculate total outgoing product quantities
        $outgoingProducts = OutgoingProduct::whereIn('product_id', $productIds)
            ->groupBy('product_id')
            ->selectRaw('product_id, SUM(quantity) as total_outgoing_quantity')
            ->pluck('total_outgoing_quantity', 'product_id');

        // Calculate remain quantities
        $remainQuantities = collect();
        foreach ($products as $product) {
            $totalQuantity = $totalQuantities[$product->id] ?? 0;
            $outgoingQuantity = $outgoingProducts[$product->id] ?? 0;
            $remainQuantity = $totalQuantity - $outgoingQuantity;
            $remainQuantities[$product->id] = $remainQuantity;
        }
        $customerId = Auth::guard('customer')->user()->id;
        $wishlistItems = Wishlist::where('customer_id', $customerId)->with('product', 'product.inventory')->get();
        return view('pages.wishlist', compact('wishlistItems', 'remainQuantities'));
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
