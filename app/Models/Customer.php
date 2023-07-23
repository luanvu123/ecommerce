<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;
    protected $table = 'customers';

    protected $fillable = [
        'name', 'email', 'password',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
}
