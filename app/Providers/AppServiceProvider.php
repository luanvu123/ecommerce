<?php

namespace App\Providers;


use App\Models\Category;
use App\Models\Info;
use App\Models\Policy;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Composers\CartTotalQuantityComposer;
use App\Http\View\Composers\RemainQuantitiesComposer;
use App\Models\Inventory;
use App\Models\OutgoingProduct;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $info = Info::find(1);
        $product_total = Product::all()->count();
        $category_total = Category::all()->count();
        $policy_home = Policy::where('status', 1)->get();


        $products_stock = Product::all();
        $productIds =  $products_stock->pluck('id')->toArray();
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
        foreach ($products_stock as $product) {
            $totalQuantity = $totalQuantities[$product->id] ?? 0;
            $outgoingQuantity = $outgoingProducts[$product->id] ?? 0;
            $remainQuantity = $totalQuantity - $outgoingQuantity;
            $remainQuantities[$product->id] = $remainQuantity;
        }



        //route layout
        $categories = Category::where('status', 1)->get();
        View::composer('layout', CartTotalQuantityComposer::class);
        View::composer('pages.cart', RemainQuantitiesComposer::class);
        View::share([
            'info' => $info,
            'product_total' => $product_total,
            'category_total' => $category_total,
            'categories' => $categories,
            'policy_home' => $policy_home,
            'remainQuantities' => $remainQuantities,
            'totalQuantities'=> $totalQuantities,
            'outgoingProducts'=> $outgoingProducts,
        ]);
    }
}
