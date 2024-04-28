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
        'message',
        'paymentId'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
      public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
     public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
     public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }
}
