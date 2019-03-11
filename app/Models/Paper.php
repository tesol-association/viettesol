<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $table = 'papers';

    public function track()
    {
        return $this->belongsTo('App\Models\Track', 'track_id');
    }
}
