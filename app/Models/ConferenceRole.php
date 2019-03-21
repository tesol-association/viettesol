<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceRole extends Model
{
    protected $table = 'conference_roles';
    protected $fillable = [
    	'name',
    	'description',
    	'conference_id',
    ];

    public function user()
    {
    	return $this->belongsToMany('App\Models\User', 'user_conference_roles', 'user_id', 'conference_role_id');
    }
}
