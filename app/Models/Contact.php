<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    public function contactType()
    {
    	return $this->belongsTo('App\Models\ContactType', 'type_id');
    }

    public function membership()
    {
    	return $this->hasOne('App\Models\Membership', 'contact_id');
    }
}
