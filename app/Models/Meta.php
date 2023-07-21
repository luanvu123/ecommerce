<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    protected $fillable = ['meta_key', 'meta_value'];

    // Định nghĩa quan hệ many-to-many với bảng products
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}

