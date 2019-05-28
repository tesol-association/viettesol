<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConferenceGalleryPolicies
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the conference gallery.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasAccess('view-conference-gallery');
    }

    /**
     * Determine whether the user can create conference galleries.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess('create-conference-gallery');
    }

    /**
     * Determine whether the user can update the conference gallery.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        //
    }

    /**
     * Determine whether the user can delete the conference gallery.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->hasAccess('delete-conference-gallery');
    }

}
