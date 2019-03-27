<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewForm extends Model
{
    protected $table = "review_form";

    public function criteriaReviews()
    {
        return $this->hasMany('App\Models\CriteriaReview', 'review_form_id');
    }
}
