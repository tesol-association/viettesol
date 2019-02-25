<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table='menu';

    protected $fillable=['id', 'name', 'url', 'description', 'created_by', 'parent_id'];
}
