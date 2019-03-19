<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
	const STATUS_UNSCHEDULER = 'unscheduler';
	const STATUS_SCHEDULER   = 'scheduler';
    protected $table = 'papers';

    public function track()
    {
        return $this->belongsTo('App\Models\Track', 'track_id');
    }
    public function schedule()
	{
		return $this->belongsTo('App\Models\Schedule', 'id');
	}
}
