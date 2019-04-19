<?php

namespace App\Policies;

use App\Models\Track;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrackPolicies
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the track.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Track  $track
     * @return mixed
     */
    public function view(User $user, Track $track)
    {
        return $user->hasAccess('view-track');
    }

    /**
     * Determine whether the user can create tracks.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess('create-track');
    }

    /**
     * Determine whether the user can update the track.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Track  $track
     * @return mixed
     */
    public function update(User $user, Track $track)
    {
        return $user->hasAccess('update-track');
    }

    /**
     * Determine whether the user can delete the track.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Track  $track
     * @return mixed
     */
    public function delete(User $user, Track $track)
    {
        //
    }

}
