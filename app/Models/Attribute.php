<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public function values()
    {
        return $this->hasMany('App\Models\AttributeValues', 'attribute_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'category_attributes', 'attribute_id');
    }
}
