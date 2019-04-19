<?php

namespace App\Policies;

use App\Models\User;
use App\SessionType;
use Illuminate\Auth\Access\HandlesAuthorization;

class SessionTypePolicies
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the session type.
     *
     * @param  \App\Models\User  $user
     * @param  \App\SessionType  $sessionType
     * @return mixed
     */
    public function view(User $user, SessionType $sessionType)
    {
        return $user->hasAccess('view-session-type');
    }

    /**
     * Determine whether the user can create session types.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess('create-session-type');
    }

    /**
     * Determine whether the user can update the session type.
     *
     * @param  \App\Models\User  $user
     * @param  \App\SessionType  $sessionType
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasAccess('update-session-type');
    }

    /**
     * Determine whether the user can delete the session type.
     *
     * @param  \App\Models\User  $user
     * @param  \App\SessionType  $sessionType
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasAccess('delete-session-type');
    }

    /**
     * Determine whether the user can restore the session type.
     *
     * @param  \App\Models\User  $user
     * @param  \App\SessionType  $sessionType
     * @return mixed
     */
    public function restore(User $user, SessionType $sessionType)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the session type.
     *
     * @param  \App\Models\User  $user
     * @param  \App\SessionType  $sessionType
     * @return mixed
     */
    public function forceDelete(User $user, SessionType $sessionType)
    {
        //
    }
}
