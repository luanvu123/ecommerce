<?php


namespace App\Http\View\Composers;

use App\Models\Cart;
use App\Models\Inventory;
use App\Models\OutgoingProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RemainQuantitiesComposer
{
    public function compose(View $view)
    {
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

        // Pass the remainQuantities data to the view
        $view->with('remainQuantities', $remainQuantities);
    }
}
