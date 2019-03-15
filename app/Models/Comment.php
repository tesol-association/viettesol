<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table="comments";

    protected $fillable=[
      'id', 'body', 'user_id', 'new_id'
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function news()
    {
    	return $this->belongsTo('App\Models\News', 'new_id');
    }
}
