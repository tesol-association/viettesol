<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConferenceTimelinePolicies
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasAccess('view-conference-timeline');
    }

    /**
     * Determine whether the user can create conference timelines.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess('create-conference-timeline');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->hasAccess('update-conference-timeline');
    }

    /**
     * Determine whether the user can delete the conference timeline.
     *
     * @param  \App\Models\User  $user
     * @param  \App\ConferenceTimeline  $conferenceTimeline
     * @return mixed
     */
    public function delete(User $user)
    {
        //
    }
}
