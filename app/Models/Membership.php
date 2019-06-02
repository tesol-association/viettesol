<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    //
    protected $table = 'membership';

    public function contact()
    {
    	return $this->belongsTo('App\Models\Contact', 'contact_id');
    }


    public function msType()
    {
    	return $this->belongsTo('App\Models\MembershipType', 'type_id');
    }
}
