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
    public function papers()
    {
    	return $this->hasMany('App\Models\Paper', 'session_type_id');
    }
    public function conference()
    {
        return $this->belongsTo('App\Models\Conference');
    }
}
