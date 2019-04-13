<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    protected $table = "membership_types";

    public function membership()
    {
    	return $this->hasMany('App\Models\Membership', 'type_id');
    }
}
