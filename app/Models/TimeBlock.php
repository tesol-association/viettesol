<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeBlock extends Model
{
	protected $table="time_block";

	protected $fillable=[
		'id', 'date', 'start_time', 'end_time', 'conference_id', 'color'
	];
	public function schedule()
    {
    	 return $this->belongsTo('App\Models\Schedule', 'id');
    }			
}
