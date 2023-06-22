<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
         $product_total = Product::all()->count();
        $category_total = Category::all()->count();
         View::share([
            'product_total' => $product_total,
            'category_total' => $category_total,
        ]);
    }
}
