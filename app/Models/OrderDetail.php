<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price_detail',
        'subtotal_detail',
        'sku_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
