<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferencePartnerSponser extends Model
{
    protected $table = 'conference_partners_sponsers';
    protected $fillable = [
    	'name',
    	'description',
    	'logo',
    	'type',
    	'conference_id'
    ];
}
