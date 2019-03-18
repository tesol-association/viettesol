<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionType extends Model
{
    protected $table = 'session_types';
    protected $fillable = [
    	'name',
    	'description',
    	'length',
    	'abstract_length',
    	'conference_id'
    ];
}
