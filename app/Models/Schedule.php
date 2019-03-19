<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
	protected $table="schedule";

	protected $fillable=[
		'id', 'paper_id', 'time_block_id', 'room_id', 'status'
	];
	public function timeblocks()
	{
		return $this->hasMany('App\Models\TimeBlock', 'id');
	}
	public function papers()
	{
		return $this->hasMany('App\Models\Paper', 'id');
	}
	public function rooms()
	{
		return $this->hasMany('App\Models\Room', 'id');
	}
	// public function buildings()
	// {
	// 	return $this->hasMany('App\Models\Buildings', 'id');
	// }
}
