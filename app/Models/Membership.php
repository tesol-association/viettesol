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

<<<<<<< HEAD
    public function msType()
    {
    	return $this->belongsTo('App\Models\MembershipType', 'type_id');
=======
    public function memberType()
    {
    	return $this->belongsTo('App\Models\MemberType', 'type_id');
>>>>>>> ba88a9a26f479319b5c9c4645e7b5cbcfe0c688b
    }
}
