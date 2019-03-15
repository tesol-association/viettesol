<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    //
    protected $table = "contributions";

    public function contact()
    {
    	return $this->belongsTo('App\Models\Contact', 'contact_id');
    }
}
