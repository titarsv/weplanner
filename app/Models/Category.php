<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_categories', 'category_id');
    }

    public function attributes()
    {
        return $this->belongsToMany('App\Models\Attribute', 'category_attributes', 'category_id');
    }
}
