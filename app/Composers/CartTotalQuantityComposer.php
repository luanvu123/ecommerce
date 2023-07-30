<?php

namespace App\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartTotalQuantityComposer
{
    public function compose(View $view)
    {
        $customer = Auth::guard('customer')->user();
        $cartTotalQuantity = $customer?->id ? Cart::where('customer_id', $customer->id)->sum('quantity') : 0;
        $view->with('cartTotalQuantity', $cartTotalQuantity);
    }
}

