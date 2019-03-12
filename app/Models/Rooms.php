<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    protected $table = 'rooms';
    protected $fillable = [
    	'name',
    	'abbrev',
    	'description',
    	'building_id'
    ];
}
