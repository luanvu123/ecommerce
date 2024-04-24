<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

