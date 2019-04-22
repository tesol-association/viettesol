<?php

namespace App\Policies;

use App\Models\User;
use App\SessionType;
use Illuminate\Auth\Access\HandlesAuthorization;

class SessionTypePolicies
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
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

}
