<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class UserData extends Model
{
    protected $table = 'users_data';

    protected $fillable = [
        'user_id',
        'image_id',
        'address',
        'company',
        'average_bill',
        'preview',
        'other_data',
        'wishlist',
        'subscribe'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function image()
    {
        return $this->belongsTo('App\Models\File');
    }

    public function getOtherData(){
        return json_decode($this->attributes['other_data']);
    }

    public function getUrlAttribute(){
        $data = $this->getOtherData();

        return empty($data->url) ? '' : $data->url;
    }

    public function getAboutAttribute(){
        $data = $this->getOtherData();

        return empty($data->about) ? '' : $data->about;
    }

    public function getGalleryAttribute(){
        $data = $this->getOtherData();

        return empty($data->gallery) ? [] : File::wherein('id', $data->gallery)->get();
    }

    public function getCountryNameAttribute(){
        $settings = new Setting();
        $settings = $settings->get_global();
        $countries = $settings->countries;

        if(isset($countries[$this->attributes['country']])){
            $locale = App::getLocale();

            if(isset($countries[$this->attributes['country']]->$locale))
                return $countries[$this->attributes['country']]->$locale;
            else
                return '';
        }else{
            return '';
        }
    }

    public function getCityNameAttribute(){
        $settings = new Setting();
        $settings = $settings->get_global();
        $cities = $settings->cities;

        if(isset($cities[$this->attributes['city']])){
            $locale = App::getLocale();

            if(isset($cities[$this->attributes['city']]->$locale))
                return $cities[$this->attributes['city']]->$locale;
            else
                return '';
        }else{
            return '';
        }
    }
}
