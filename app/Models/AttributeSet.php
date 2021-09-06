<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model
{
    use HasFactory;

    function attributeValue(){
        return $this->hasMany(AttributeValue::class, 'attributeset_id');
    }

}
