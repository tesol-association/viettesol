<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
    protected $table = 'announcements';
    protected $fillable = [
    	'title',
    	'body',
    	'conference_id',
    	'expiry_date',
    	'status',
    	'short_content'
    ];
}
