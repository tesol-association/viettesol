<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = [
        'name',
        'abbrev',
        'description',
        'policy',
        'conference_id'
    ];

    public function papers()
    {
        return $this->hasMany('App\Models\Paper', 'track_id');
    }

    public function conference()
    {
        return $this->belongsTo('App\Models\Conference', 'conference_id');
    }

    public function reviewForm()
    {
        return $this->belongsTo('App\Models\ReviewForm', 'review_form_id');
    }
}
