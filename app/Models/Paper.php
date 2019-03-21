<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    const STATUS_SUBMITTED = 'submitted';
    protected $table = 'papers';

    public function track()
    {
        return $this->belongsTo('App\Models\Track', 'track_id');
    }

    public function authors()
    {
        return $this->belongsToMany('App\Models\Author', 'paper_author', 'paper_id', 'author_id');
    }

    public function sessionType()
    {
        return $this->belongsTo('App\Models\SessionType', 'session_type_id');
    }
}
