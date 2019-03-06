<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $table = 'event_categories';

    public function categoryLinks()
    {
        return $this->hasMany('App\Models\EventCategoryLink', 'category_id');
    }
}
