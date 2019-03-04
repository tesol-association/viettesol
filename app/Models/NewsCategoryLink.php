<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategoryLink extends Model
{
    protected $table = 'new_category_links';

    public function new()
    {
        return $this->belongsTo('App\Models\News', 'new_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\NewsCategory', 'category_id');
    }
}
