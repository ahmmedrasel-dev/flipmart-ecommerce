<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    function subsubcategory(){
        return $this->hasMany(Subsubcategory::class, 'subcategory_id');
    }

    function product(){
        return $this->hasMany(Product::class, 'subcategory_id');
    }



}

