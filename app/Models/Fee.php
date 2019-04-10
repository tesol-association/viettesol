<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $table = 'fees';
    protected $fillable = [
        'category',
        'time',
        'price_before_time',
        'price_after_time',
        'conference_id',
        'description'
    ];
}
