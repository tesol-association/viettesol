<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TimeBlockPolicies
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the time block.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TimeBlock  $timeBlock
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasAccess('view-time-block');
    }

    /**
     * Determine whether the user can create time blocks.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess('create-time-block');
    }

    /**
     * Determine whether the user can update the time block.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TimeBlock  $timeBlock
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasAccess('update-time-block');
    }

    /**
     * Determine whether the user can delete the time block.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TimeBlock  $timeBlock
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasAccess('delete-time-block');
    }

}
