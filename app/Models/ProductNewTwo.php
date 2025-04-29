<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductNewTwo extends Model
{
    
    public function category()
    {
        return $this->belongsTo(CategoryNew::class);
    }
}
