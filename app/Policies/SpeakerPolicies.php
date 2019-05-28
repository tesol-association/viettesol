<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpeakerPolicies
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasAccess('view-speaker');
    }

    /**
     * Determine whether the user can create speakers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess('create-speaker');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->hasAccess('update-speaker');
    }


    public function delete(User $user)
    {
        return $user->hasAccess('delete-speaker');
    }

}
