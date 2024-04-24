<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'limit_per_user',
        'limit_per_coupon',
        'expires_at',
        'status'
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
