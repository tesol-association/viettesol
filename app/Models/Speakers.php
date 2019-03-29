<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speakers extends Model
{
    protected $table = 'speakers';
    protected $fillable = [
    	'full_name',
    	'affiliate',
    	'biography',
    	'image',
    	'site_url',
    	'abstract',
    	'attach_file',
    	'conference_id'
    ];

    public function conference()
    {
        return $this->belongsTo('App\Models\Conference', 'conference_id');
    }
}
