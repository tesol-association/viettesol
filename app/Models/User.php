<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'first_name',
        'middle_name',
        'last_name',
        'affiliation',
        'gender',
        'initals',
        'is_admin',
        'role_id',
        'phone',
        'country',
        'image',
        'disable',
        'fax',
        'email',
        'password',
        'last_login',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }

    public function news()
    {
        return $this->hasMany('App\Models\News');
    }

    public function conferenceRoles()
    {
        return $this->belongsToMany('App\Models\ConferenceRole', 'user_conference_roles', 'user_id', 'conference_role_id');
    }

    public function token()
    {
        return $this->hasOne('App\Models\UserToken');
    }

    public function tracks()
    {
        return $this->belongsToMany('App\Models\Track', 'track_director', 'user_id', 'track_id');
    }

    public function criteria()
    {
        return $this->hasMany('App\Models\ReviewCriteria');
    }

    public function isSuperAdmin(): bool
    {
        if ($this->is_admin == 1) {
            return true;
        }
        return false;
    }

    public function hasAccess(string $permission): bool
    {
        foreach ($this->conferenceRoles as $conferenceRole) {
            if ($conferenceRole->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }
}
