<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Config;

class Category extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'slug',
        'description',
        'description_en',
        'parent',
        'count',
        'currency'
    ];

    public $timestamps = false;

    public function getNameAttribute($value){
        $locale = Config::get('app.locale');

        if(isset($this->attributes["name_$locale"]))
            return $this->attributes["name_$locale"];
        else
            return $value;
    }

    public function getDescriptionAttribute($value){
        $locale = Config::get('app.locale');

        if(isset($this->attributes["description_$locale"]))
            return $this->attributes["description_$locale"];
        else
            return $value;
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_categories', 'category_id');
    }

    public function attributes()
    {
        return $this->belongsToMany('App\Models\Attribute', 'category_attributes', 'category_id');
    }

    /**
     * Корневые категории
     *
     * @return mixed
     */
    public function get_parent_categories(){
        return $this->where('parent', 0)
            ->get();
    }
}
