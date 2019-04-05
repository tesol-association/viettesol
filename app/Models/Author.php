<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }

    public function papers()
    {
        return $this->belongsToMany('App\Models\Paper', 'paper_author', 'author_id', 'paper_id')->withPivot('seq','id');
    }
}
