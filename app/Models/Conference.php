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

    public function sessionTypes()
    {
        return $this->hasMany('App\Models\SessionType');
    }

    public function timeline()
    {
        return $this->hasOne('App\Models\ConferenceTimeline', 'conference_id');
    }

    public function speakers()
    {
        return $this->hasMany('App\Models\Speakers', 'conference_id');
    }

    public function sponsers()
    {
        return $this->hasMany('App\Models\ConferencePartnerSponser', 'conference_id');
    }

}
