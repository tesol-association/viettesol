<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $table = 'conferences';

    public function tracks()
    {
        return $this->hasMany('App\Models\Track');
    }

    public function timeline()
    {
        return $this->hasOne('App\Models\ConferenceTimeline', 'conference_id');
    }
}
