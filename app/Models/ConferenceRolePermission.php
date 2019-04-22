<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceRolePermission extends Model
{
    protected $table = 'conference_roles_permissions';
    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo('App\Models\ConferenceRole', 'conference_role_id');
    }

    public function permission()
    {
        return $this->belongsTo('App\Models\ConferencePermission', 'conference_permission_id');
    }
}
