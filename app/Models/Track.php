<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
//    protected $fillable = [
//        'name',
//        'abbrev',
//        'description',
//        'policy',
//        'conference_id',
//        'keywords'
//    ];

    /**
     * @param array $value
     */
    public function setKeywordsAttribute(array $value)
    {
        $this->attributes['keywords'] = json_encode($value);
    }

    /**
     * @param $value
     * @return array
     */
    public function getKeywordsAttribute($value)
    {
        return json_decode($value, true);
    }

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

     public function users()
    {
        return $this->belongsToMany('App\Models\User', 'track_director', 'track_id', 'user_id');
    }
}
