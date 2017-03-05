<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class Service extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'category_id'
    ];

    public function category()
    {
        return $this->hasOne('App\Models\Category');
    }

    public function getNameAttribute($value){
        $locale = App::getLocale();

        if(isset($this->attributes["name_$locale"]))
            return $this->attributes["name_$locale"];
        else
            return $value;
    }
}
