<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventCategoryLink extends Model
{
    protected $table = 'event_category_links';

    public function event()
    {
        return $this->belongsTo('App\Models\Event', 'event_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\EventCategory', 'category_id');
    }
}
