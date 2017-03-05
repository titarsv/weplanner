<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use Illuminate\Support\Facades\Cache;

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
        'currency',
        'currency_en'
    ];

    public $timestamps = false;

    public function getNameAttribute($value){
        $locale = App::getLocale();

        if(isset($this->attributes["name_$locale"]))
            return $this->attributes["name_$locale"];
        else
            return $value;
    }

    public function getDescriptionAttribute($value){
        $locale = App::getLocale();

        if(isset($this->attributes["description_$locale"]))
            return $this->attributes["description_$locale"];
        else
            return $value;
    }

    public function getCurrencyAttribute($value){
        $locale = App::getLocale();

        if(isset($this->attributes["currency_$locale"]))
            return $this->attributes["currency_$locale"];
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

    public function services()
    {
        return $this->hasMany('App\Models\Service', 'category_id', 'id');
    }

    /**
     * Корневые категории
     *
     * @return mixed
     */
    public function get_parent_categories(){
        $categories = Cache::remember('parent_categories', 120, function()
        {
            return $this->where('parent', 0)
                ->get();
        });

        return $categories;
    }

    /**
     * Выборка подрядчиков в категории
     *
     * @param $filters
     * @param $sort
     * @return mixed
     */
    public function searchContractors($filters, $sort){
        $contractors = $this->users()
            ->join('role_users', function ($join) {
                $join->on('users.id', '=', 'role_users.user_id');
            })
            ->join('users_data', function ($join) {
                $join->on('users.id', '=', 'users_data.user_id');
            })
            ->where('role_users.role_id', 5)
            ->with('user_data', 'avatar');

        foreach ($filters as $filter){
            $contractors->where($filter[0], $filter[1]);
        }

        $per_page = config('view.product_quantity');

        return $contractors->paginate($per_page);
    }
}
