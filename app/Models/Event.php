<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

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
        return $this->hasMany('App\Models\EventCategoryLink', 'event_id');
    }
}
