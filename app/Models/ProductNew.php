<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductNew extends Model
{
    public function category()
    {
        return $this->belongsTo(ProductNew::class);
    }
}
