<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaperEventLog extends Model
{
    protected $table = 'paper_event_log';
    protected $fillable = [
        'paper_id',
        'user_id',
        'message',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function paper()
    {
        return $this->belongsTo('App\Models\Paper', 'paper_id');
    }
}
