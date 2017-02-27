<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'attribute_id'
    ];

    public function attribute()
    {
        return $this->belongsTo('App\Models\Attribute', 'attribute_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_attributes');
    }
}
