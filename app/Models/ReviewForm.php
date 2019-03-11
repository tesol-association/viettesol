<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewForm extends Model
{
    protected $table = "review_form";

    public function reviewCriteriaLink()
    {
        return $this->hasMany('App\Models\ReviewFormSetting', 'review_form_id');
    }
}
