<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'detail', 'price', 'image_product', 'category_id', 'reduced_price', 'hot_deals', 'status', 'most_sold', 'new_viral', 'status', 'image_id', 'supplier_id','description'
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
        return $this->belongsTo(Meta::class, 'meta_id');
    }
    public function product_meta()
    {
        return $this->belongsToMany(Meta::class, 'product_meta', 'product_id', 'meta_id')
            ->withPivot('meta_value')
            ->withTimestamps();
    }
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
     public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }
     public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
      public function outgoing_product()
    {
        return $this->hasOne(OutgoingProduct::class);
    }

     public function skus(): HasMany 
    {
        return $this->hasMany(Sku::class);
    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
