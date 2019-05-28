<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicies
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasAccess('view-announcement');
    }

    /**
     * Determine whether the user can create announcements.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess('create-announcement');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->hasAccess('update-announcement');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasAccess('delete-announcement');
    }

}
