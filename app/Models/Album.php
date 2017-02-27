<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'name',
        'description',
        'cover',
        'user_id',
        'content',
        'type'
    ];

    public function thumb(){
        return $this->hasOne('App\Models\File', 'id', 'cover');
    }

    public function setContentAttribute($content){
        if(!is_string($content))
            $this->attributes['content'] = json_encode($content);
    }

    public function getContentAttribute($content){
        return json_decode($content);
    }

    /**
     * Портфолио наших пользователей
     *
     * @return mixed
     */
    public function get_portfolios(){
        return $this->where('type', 'photo')
            ->orderBy('id', 'desc')
            ->take(22)
            ->with('thumb')
            ->get();
    }
}
