<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConferenceRole extends Model
{
    const TRACK_DIRECTOR = 'Track Director';
    const REVIEWER = 'Reviewer';
    const AUTHOR = 'author';
    protected $table = 'conference_roles';
    protected $fillable = [
    	'name',
    	'description',
    	'conference_id',
    ];

    public function user()
    {
    	return $this->belongsToMany('App\Models\User', 'user_conference_roles', 'conference_role_id', 'user_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\ConferencePermission', 'conference_roles_permissions', 'conference_role_id', 'conference_permission_id')->withPivot('allowed');
    }

    public function hasPermission(string $permission): bool
    {
        $permissions = $this->permissions()->where('allowed', 1)->pluck('name')->all();
        return in_array($permission, $permissions);
    }

}
