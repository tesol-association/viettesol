<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberType extends Model
{
    //
    protected $table = "membership_types";

    protected $fillable = [
    	'name',
    	'description'
    ];

    public function membership()
    {
    	return $this->hasOne('App\Models\Membership', 'type_id');
    }
}
