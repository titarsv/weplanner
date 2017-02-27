<?php

namespace App\Models;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Support\Facades\DB;

class User extends \Cartalyst\Sentinel\Users\EloquentUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
    ];
    /**
     * Array of login column names.
     *
     * @var array
     */
    protected $loginNames = ['phone'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return Sentinel::findById($this->id)->roles()->pluck('slug')->toArray();
    }

    public function user_data()
    {
        return $this->hasOne('App\Models\UserData', 'user_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review', 'user_id', 'id');
    }

    public function categories(){
        return $this->belongsToMany('App\Models\Category', 'user_categories', 'user_id', 'category_id');
    }

    public function services(){
        return $this->belongsToMany('App\Models\Services', 'user_services', 'user_id', 'service_id');
    }

    public function attributes(){
        return $this->belongsToMany('App\Models\AttributeValue', 'user_attributes', 'user_id', 'attribute_value_id');
    }

    /**
     * Получение списка желаний пользователя в виде массива id товаров или коллекции товаров
     * в зависимости от входящего аргумента
     *
     * @param $type = array or object
     * @return array|mixed|void
     */
    public function wishlist($type = 'object')
    {
        if (!is_null($this->user_data->wishlist)) {
            if ($type == 'array') {
                return json_decode($this->user_data->wishlist, true);
            } elseif ($type == 'object') {
                $product = new Product;
                return $product->getProducts(json_decode($this->user_data->wishlist, true));
            }
        } else {
            return [];
        }
    }

    public function checkIfUnregistered($phone, $email){
        return $this->where('email', $email)->orWhere('phone', $phone)->first();
    }

    /**
     * Получить популярных подрядчиков
     *
     * @return mixed
     */
    public function get_popular_contractors()
	{
	    $contractors = $this->select([
	        'users.id',
            'users.avatar',
            'users.first_name',
            'users.last_name',
            'users.city',
            'users_data.rating',
            'users_data.price',
            'users_data.cur',
            'users_data.category',
            'users_data.profession',
            'users_data.page_brief',
            'terms.name',
            'terms.name_en'
        ]);

        $contractors->join('personal_pages', 'users.id', '=', 'personal_pages.user_id')
            ->join('terms', 'personal_pages.category', '=', 'terms.term_id')
            ->order_by('users.rating', 'desc')
            ->paginate(12);

		return $contractors;
	}
}
