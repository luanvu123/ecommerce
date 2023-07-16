<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Policy;
use App\Models\Poster;
use App\Models\Product;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $hot_products = Product::orderBy('updated_at', 'desc')->where('hot_deals', 1)->where('status', 1)->take(5)->get();
        $newviral_products = Product::orderBy('updated_at', 'desc')->where('new_viral', 1)->where('status', 1)->take(15)->get();
        $mostsold_products = Product::orderBy('updated_at', 'desc')->where('most_sold', 1)->where('status', 1)->take(8)->get();
        $category_home = Category::with('products')->where('status', 1)->get();
        $posters = Poster::where('status', 1)->get();
        $category_home->each(function ($category) {
            $category->products->each(function ($product) {
                $price = $product->price; // Giá gốc
                $reducedPrice = $product->reduced_price; // Giá giảm
                $discountPercentage = round((($price - $reducedPrice) / $price) * 100);
                $product->discountPercentage = $discountPercentage;
            });
        });
        $newviral_products->each(function ($product) {
            $price = $product->price; // Giá gốc
            $reducedPrice = $product->reduced_price; // Giá giảm
            $discountPercentage = round((($price - $reducedPrice) / $price) * 100);
            $product->discountPercentage = $discountPercentage;
        });
        return view('pages.home', [
            'hot_products' => $hot_products,
            'newviral_products' => $newviral_products,
            'mostsold_products' => $mostsold_products,
            'category_home' => $category_home,
            'posters' => $posters,
        ]);
    }



    public function category($slug)
    {
        $category = Category::where('slug', $slug)->where('status', 1)->first();

        if ($category) {
            $products = $category->products;

            $products->each(function ($product) {
                $price = $product->price; // Giá gốc
                $reducedPrice = $product->reduced_price; // Giá giảm
                $discountPercentage = round((($price - $reducedPrice) / $price) * 100);
                $product->discountPercentage = $discountPercentage;
            });

            return view('pages.category', [
                'cate_slug' => $category,
                'products' => $products,
            ]);
        } else {
            abort(404);
        }
    }





    public function contact()
    {
        return view('pages.contact');
    }
    public function cart()
    {
        return view('pages.cart');
    }
    public function shop()
    {
        $category_home = Category::with('products')->where('status', 1)->get();
        $category_home->each(function ($category) {
            $category->products->each(function ($product) {
                $price = $product->price; // Giá gốc
                $reducedPrice = $product->reduced_price; // Giá giảm
                $discountPercentage = round((($price - $reducedPrice) / $price) * 100);
                $product->discountPercentage = $discountPercentage;
            });
        });

        return view('pages.shop', [
            'category_home' => $category_home,
        ]);
    }
    public function wishlist()
    {
        return view('pages.wishlist');
    }
    public function privacyPolicy()
    {
        return view('pages.privacy-policy');
    }
    public function termsOfService()
    {
        return view('pages.terms-of-service');
    }
}
