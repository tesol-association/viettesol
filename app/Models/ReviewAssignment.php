<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewAssignment extends Model
{

    protected $table = 'review_assignments';

    public function paper()
    {
        return $this->belongsTo('App\Models\Paper', 'paper_id');
    }

    public function reviewer()
    {
        return $this->belongsTo('App\Models\User', 'reviewer_id');
    }

    /**
     * @param $value
     */
    public function setReviewerResponseAttribute($value)
    {
        $this->attributes['reviewer_response'] = json_encode($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getReviewerResponseAttribute($value)
    {
        return json_decode($value, true);
    }
}
