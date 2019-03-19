<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buildings extends Model
{
    protected $table = 'buildings';
    protected $fillable = [
    	'name',
    	'abbrev',
    	'description',
    	'conference_id'
    ];

    public function rooms()
    {
    	return $this->hasMany('App\Models\Rooms', 'building_id');
    }

     public function conference(){
        return $this->belongsTo('App\Models\Conference', 'conference_id');
    }
}
