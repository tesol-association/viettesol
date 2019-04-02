<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';

        public function papers()
    {
        return $this->belongsToMany('App\Models\Paper', 'paper_author', 'author_id', 'paper_id')->withPivot('seq','id');
    }
}
