<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackDecision extends Model
{
    protected $table = 'track_decisions';

    public function user()
    {
        return $this->beLongsTo('App\Models\User', 'track_director_id');
    }
}
