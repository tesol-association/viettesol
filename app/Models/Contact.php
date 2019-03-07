<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $table = 'contacts';

    protected $fillable = 
    [
    	'type',
    	'first_name',
    	'middle_name',
    	'last_name',
    	'organize_name',
    	'address',
    	'email',
    	'phone',
    	'fax',
    	'country',
    	'website',
    	'note'
    ];
}
