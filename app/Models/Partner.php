<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table="partners_sponsors";
    protected $fillable=[
       'id', 'name', 'description', 'logo', 'type'
    ];
}
