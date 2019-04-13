<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $table="event_registation";

    protected $fillable=[
      'id', 'full_name', 'gender', 'affiliation', 'department', 'position', 'address', 'email', 'phone', 'highest_degree', 'email_notify', 'event_id','extra'
    ];
}
