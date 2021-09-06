<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    function subcategory(){
        return $this->hasMany(Subcategory::class, 'category_id');
    }

    function subsubcategory(){
        return $this->hasMany(Subsubcategory::class, 'subcategory_id');
    }

    function product(){
        return $this->hasMany(Product::class, 'category_id');
    }

}
