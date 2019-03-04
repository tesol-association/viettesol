<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table='menu';

    protected $fillable=['id', 'name', 'url', 'description', 'created_by', 'parent_id'];
    // public function parent()
    // {
    //     return $this->belongsTo('App\Models\Menu', 'parent_id');
    // }
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }
}
