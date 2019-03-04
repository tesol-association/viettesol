<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    public function lastUpdatedBy()
    {
        return $this->belongsTo('App\Models\User', 'last_updated_by');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function categoryLinks()
    {
        return $this->hasMany('App\Models\NewsCategoryLink', 'new_id');
    }
}
