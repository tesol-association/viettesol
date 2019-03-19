<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
	protected $table="schedule";

	protected $fillable=[
		'id', 'paper_id', 'time_block_id', 'room_id', 'status'
	];
	public function timeblock()
	{
		return $this->hasMany('App\Models\TimeBlock', 'id');
	}
	public function paper()
	{
		return $this->hasMany('App\Models\Paper', 'id');
	}
	public function room()
	{
		return $this->hasMany('App\Models\Room', 'id');
	}
	// public function buildings()
	// {
	// 	return $this->hasMany('App\Models\Buildings', 'id');
	// }
}
