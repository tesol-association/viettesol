<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
	const STATUS_UNSCHEDULER = 'unscheduled';
	const STATUS_SCHEDULER   = 'scheduled';
    const STATUS_SUBMITTED = 'submitted';
    protected $table = 'papers';

    public function track()
    {
        return $this->belongsTo('App\Models\Track', 'track_id');
    }
<<<<<<< HEAD
    public function schedule()
	{
		return $this->belongsTo('App\Models\Schedule', 'id');
	}
	public function sessionType()
	{
		return $this->belongsTo('App\Models\SessionType', 'session_type_id');
	}
=======

    public function authors()
    {
        return $this->belongsToMany('App\Models\Author', 'paper_author', 'paper_id', 'author_id');
    }
>>>>>>> 0459e681665d79877ab3c0bfd1976425e9dc067f
}
