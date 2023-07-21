<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    protected $fillable = ['meta_key', 'meta_value'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

