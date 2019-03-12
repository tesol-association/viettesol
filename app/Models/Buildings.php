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
}
