<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaperFile extends Model
{
    protected $table = 'paper_files';
    protected $fillable = [
        'paper_id',
        'revision',
        'path',
        'file_size',
        'original_file_name',
        'type'
    ];

    public function paper()
    {
        return $this->belongsTo('App\Models\Paper', 'paper_id');
    }
}
