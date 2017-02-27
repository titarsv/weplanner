<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public $table = 'users_data';

    public $fillable = [
        'wishlist'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Добавление товара в список закладок
     *
     * @param $product_id
     * @param $user_id
     * @return int
     */
    public function addToWishlist($product_id, $user_id)
    {
        $user_data = $this->where('user_id', $user_id)->first();
        $current_wishlist = json_decode($user_data->wishlist, true);

        if (!empty($current_wishlist)) {
           array_push($current_wishlist, $product_id);
        } else {
            $current_wishlist = [$product_id];
        }

        $user_data->wishlist = json_encode($current_wishlist);
        $user_data->save();

        return count($current_wishlist);
    }

    /**
     * Удаление товара из списка закладок
     *
     * @param $product_id
     * @param $user_id
     * @return int
     */
    public function removeFromWishlist($product_id, $user_id)
    {
        $user_data = $this->where('user_id', $user_id)->first();
        $wishlist = json_decode($user_data->wishlist, true);

        $key = array_search($product_id, $wishlist);

        if ($key !== false) {
            unset($wishlist[$key]);
        }

        $user_data->wishlist = json_encode($wishlist);
        $user_data->save();

        return count($wishlist);
    }

}
