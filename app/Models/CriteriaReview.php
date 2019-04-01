<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CriteriaReview extends Model
{
    protected $table = 'criteria_review';

    public function reviewForm()
    {
        return $this->belongsTo('App\Models\ReviewForm', 'review_form_id');
    }

    /**
     * @param $value
     */
    public function setPossibleValuesAttribute($value)
    {
        $this->attributes['possible_values'] = json_encode($value);
    }
    /**
     * @param $value
     * @return mixed
     */
    public function getPossibleValuesAttribute($value)
    {
        return json_decode($value, true);
    }
}
