<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'detail', 'price', 'image_product', 'category_id', 'reduced_price', 'image_product2', 'image_product3', 'image_product4', 'image_product5', 'hot_deals', 'status'
    ];

    /**
     * Get the parent category that the product belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
