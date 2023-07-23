<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Policy;
use App\Models\Poster;
use App\Models\Product;
use App\Models\ProductImage;
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


    public function search()
    {
        if (isset($_GET['prod-search'])) {
            $search = $_GET['prod-search'];
            $products = Product::where('status', 1)
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orderBy('updated_at', 'DESC')
                ->get();
            $products->each(function ($product) {
                $price = $product->price;
                $reducedPrice = $product->reduced_price;
                $discountPercentage = round((($price - $reducedPrice) / $price) * 100);
                $product->discountPercentage = $discountPercentage;
            });
            return view('pages.search', [
                'search' => $search,
                'products' => $products,
            ]);
        } else {
            abort(404);
        }
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

    public function product($slug)
    {
        $single_of_product = Product::where('slug', $slug)->where('status', 1)->with('images', 'product_meta')->first();
        if (!$single_of_product) {
            abort(404);
        }
        $price =  $single_of_product->price;
        $reducedPrice =  $single_of_product->reduced_price;
        $discountPercentage = round((($price - $reducedPrice) / $price) * 100);
        $single_of_product->discountPercentage = $discountPercentage;
        $viewedItems = Product::inRandomOrder()->limit(5)->get();

        return view('pages.single-product', [
            'single_of_product' =>  $single_of_product,
            'viewedItems' => $viewedItems,
        ]);
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

    public function getProduct($id)
    {
        $product = Product::with('images', 'product_meta')->findOrFail($id);
        $price =  $product->price;
        $reducedPrice =  $product->reduced_price;
        $discountPercentage = round((($price - $reducedPrice) / $price) * 100);
        $product->discountPercentage = $discountPercentage;

        // Lấy thông tin của product_meta
        $product_meta_data = [];
        foreach ($product->product_meta as $product_meta) {
            $product_meta_data[] = [
                'meta_key' => $product_meta->meta_key,
                'meta_value' => $product_meta->pivot->meta_value,
            ];
        }

        $data = [
            'name' => $product->name,
            'price' => $product->reduced_price,
            'detail' => $product->detail,
            'images' => $product->images,
            'discountPercentage' => $product->discountPercentage,
            'product_meta' => $product_meta_data,
        ];
        return response()->json($data);
    }



}
