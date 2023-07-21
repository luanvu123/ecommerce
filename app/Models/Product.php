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
        'name', 'detail', 'price', 'image_product', 'category_id', 'reduced_price', 'hot_deals', 'status'
    ];

    /**
     * Get the parent category that the product belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function metas()
    {
        return $this->belongsTo(Meta::class,'meta_id');
    }
     public function product_meta()
    {
        return $this->belongsToMany(Meta::class, 'product_meta', 'product_id', 'meta_id')
            ->withPivot('meta_value')
            ->withTimestamps();
    }
}
