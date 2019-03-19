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
    public function schedule()
	{
		return $this->belongsTo('App\Models\Schedule', 'id');
	}
	public function sessionType()
	{
		return $this->belongsTo('App\Models\SessionType', 'session_type_id');
	}
}
