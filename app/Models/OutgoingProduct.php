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
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
