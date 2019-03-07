<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $table = 'new_categories';

    public function categoryLink()
    {
        return $this->hasMany('App\Models\NewsCategoryLink', 'category_id');
    }
}
