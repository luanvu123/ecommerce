<?php


namespace App\Http\View\Composers;

use App\Models\Cart;
use App\Models\Inventory;
use App\Models\OutgoingProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RemainQuantitiesComposer
{
    public function compose(View $view)
    {
        // Get the currently logged-in customer
        $customer = Auth::guard('customer')->user();

        // Fetch all the products in the cart for the logged-in customer
        $carts = Cart::where('customer_id', $customer->id)->get();

        // Get the IDs of the products in the cart
        $productIds = $carts->pluck('product_id')->toArray();

        // Fetch the total quantities for the products in the cart
        $totalQuantities = Inventory::whereIn('product_id', $productIds)
            ->groupBy('product_id')
            ->selectRaw('product_id, SUM(quantity) as total_quantity')
            ->pluck('total_quantity', 'product_id');

        // Calculate total outgoing product quantities
        $outgoingProducts = OutgoingProduct::whereIn('product_id', $productIds)
            ->groupBy('product_id')
            ->selectRaw('product_id, SUM(quantity) as total_outgoing_quantity')
            ->pluck('total_outgoing_quantity', 'product_id');

        // Calculate remain quantities for each product
        $remainQuantities = collect();
        foreach ($carts as $cart) {
            $totalQuantity = $totalQuantities[$cart->product_id] ?? 0;
            $outgoingQuantity = $outgoingProducts[$cart->product_id] ?? 0;
            $remainQuantity = $totalQuantity - $outgoingQuantity;
            $remainQuantities[$cart->product_id] = $remainQuantity;
        }

        // Pass the remainQuantities data to the view
        $view->with('remainQuantities', $remainQuantities);
    }
}
