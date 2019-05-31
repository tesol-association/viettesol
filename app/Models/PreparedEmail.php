<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreparedEmail extends Model
{
    protected $table = 'prepared_emails';

    public function scopeEmailKey($query, $emailKey)
    {
        return $query->where('email_key', $emailKey);
    }
}
