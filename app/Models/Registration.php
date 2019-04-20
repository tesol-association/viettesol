<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table="registration";

    protected $fillable= [
       'id', 'full_name', 'organization', 'email', 'phone', 'payment_file_id', 'affiliation', 'status', 'user_id', 'role_id', 'conference_id'
    ];
}
