<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferencePermission extends Model
{
    protected $table = 'conference_permissions';
    public $timestamps = false;

    public function roles() {
        return $this->belongsToMany('App\Models\ConferenceRole', 'conference_roles_permissions', 'conference_permission_id', 'conference_role_id')->withPivot('allowed');
    }
}
