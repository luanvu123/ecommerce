<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Meta extends Model
{
    use HasFactory;
     protected $table = 'product_meta';
    //   protected $fillable = ['product_id', 'meta_id', 'meta_value'];
}
