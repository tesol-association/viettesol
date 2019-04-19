<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class UserToken extends Model
{
    protected $table= 'user_token';
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function isExpired()
    {
        return $this->created_at->diffInMinutes(Carbon::now()) > Config::get('constants.TIME_TOKEN_EXPIRED');
    }
}
