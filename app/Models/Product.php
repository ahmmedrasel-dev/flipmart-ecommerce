<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    function subcategory(){
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    function subsubcategory(){
        return $this->belongsTo(Subsubcategory::class, 'subsubcategory_id');
    }

    function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    function productGallery(){
        return $this->hasMany(ProductGallery::class, 'product_id');
    }

    function productAttribute(){
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

}
