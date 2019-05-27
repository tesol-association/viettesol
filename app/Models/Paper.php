<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    const STATUS_UNSCHEDULED = 'unscheduled';
    const STATUS_SCHEDULED   = 'scheduled';
    const STATUS_SUBMITTED = 'submitted';
    protected $table = 'papers';

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

    public function track()
    {
        return $this->belongsTo('App\Models\Track', 'track_id');
    }
    public function schedule()
    {
        return $this->belongsTo('App\Models\Schedule', 'id');
    }

    public function authors()
    {
        return $this->belongsToMany('App\Models\Author', 'paper_author', 'paper_id', 'author_id')->withPivot('seq');
    }

    public function sessionType()
    {
        return $this->belongsTo('App\Models\SessionType', 'session_type_id');
    }

    public function reviewAssignment()
    {
        return $this->hasMany('App\Models\ReviewAssignment', 'paper_id');
    }

    public function reviewers()
    {
        return $this->belongsToMany('App\Models\User', 'review_assignments', 'paper_id', 'reviewer_id');
    }

    public function attachFile()
    {
        return $this->belongsTo('App\Models\PaperFile', 'file_id');
    }

    public function histories()
    {
        return $this->hasMany('App\Models\PaperEventLog', 'paper_id');
    }
}
