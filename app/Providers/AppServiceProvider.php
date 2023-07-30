<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Info;
use App\Models\Policy;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Composers\CartTotalQuantityComposer;

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



        //route layout
        $categories = Category::where('status', 1)->get();
        View::composer('layout', CartTotalQuantityComposer::class);
        View::share([
            'info' => $info,
            'product_total' => $product_total,
            'category_total' => $category_total,
            'categories' => $categories,
            'policy_home' => $policy_home,
        ]);
    }
}
