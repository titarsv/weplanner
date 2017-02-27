<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Config;

class Term extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'slug',
        'term_group'
    ];

    public $timestamps = false;

    public function getNameAttribute($value){
        $locale = Config::get('app.locale');

        if(isset($this->attributes["name_$locale"]))
            return $this->attributes["name_$locale"];
        else
            return $value;
    }

    /**
     * Корневые категории
     *
     * @return mixed
     */
    public function get_parent_categories(){
        return $this->select('terms.term_id', 'terms.name', 'terms.name_en', 'terms.slug', 'term_taxonomy.parent', 'term_taxonomy.description', 'term_taxonomy.description_en')
            ->join('term_taxonomy', 'terms.term_id', '=', 'term_taxonomy.term_id')
            ->where('term_taxonomy.taxonomy', 'category')
            ->where('term_taxonomy.parent', 0)
            ->get();
    }
}
