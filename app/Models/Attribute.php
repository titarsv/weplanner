<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

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

    public function getNameAttribute($value){
        $locale = App::getLocale();

        if(isset($this->attributes["name_$locale"]))
            return $this->attributes["name_$locale"];
        else
            return $value;
    }
}
