<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Customer extends Authenticatable
{
    protected $table = 'customers';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    // Định nghĩa các quan hệ tương ứng trong model

    // Quan hệ một-nhiều với đơn hàng
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
