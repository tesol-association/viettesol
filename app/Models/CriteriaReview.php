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
}
