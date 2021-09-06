<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    function attributeSet(){
        return $this->belongsTo(AttributeSet::class, 'attributeset_id');
    }

    function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }


}
