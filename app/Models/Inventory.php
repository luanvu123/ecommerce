<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'quantity', 'note', 'supplier_id', 'price',
        'total_amount',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
