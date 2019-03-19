<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialEvent extends Model
{
    protected $table = 'special_events';
    protected $fillable = [
    	'name',
    	'date',
    	'start_time',
    	'end_time',
    	'conference_id',
    	'room_id',
    	'description'
    ];

    public function room()
    {
    	return $this->belongsTo('App\Models\Rooms', 'room_id');
    }
}
