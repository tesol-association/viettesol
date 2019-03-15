<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{
    //
    protected $table = 'contact_type';

    protected $fillable = 
    [
    	'name',
    	'description'
    ];

    public function contacts()
    {
    	return $this->hasMany('App\Models\Contact', 'type_id');
    }
}
