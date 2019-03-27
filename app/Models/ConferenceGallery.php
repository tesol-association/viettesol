<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceGallery extends Model
{
    protected $table = 'conference_gallery';
    protected $fillable = [
        'conference_id',
        'image_url',
        'created_by'
    ];
}
