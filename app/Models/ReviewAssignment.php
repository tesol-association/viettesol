<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewAssignment extends Model
{
    const INDEX_ASSIGNMENT = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
    protected $table = 'review_assignments';

    public function paper()
    {
        return $this->belongsTo('App\Models\Paper', 'paper_id');
    }

    public function reviewer()
    {
        return $this->belongsTo('App\Models\User', 'reviewer_id');
    }
}
