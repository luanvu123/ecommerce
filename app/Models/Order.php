<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'recipient_name',
        'recipient_phone',
        'recipient_address',
        'recipient_email',
        'total_price',
        'status',
        'payment_method',
        'shipping_id',
        'coupon_id',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
