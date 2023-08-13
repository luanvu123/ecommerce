<?php

// app/Models/OutgoingProduct.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutgoingProduct extends Model
{
    protected $table = 'outgoing_products';

    protected $fillable = [
        'product_id',
        'quantity',
        'note',
        'price',
        'total_amount',
        'supplier_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
      public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function supplier()
    {
        return $this->belongsTo(Supplier::class);  // Add the new supplier relationship
    }
}
