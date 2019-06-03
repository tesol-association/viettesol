<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConferencePermissionPolicies
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasAccess('view-conference-permission');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess('create-conference-permission');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->hasAccess('update-conference-permission');
    }

    /**
     * Determine whether the user can view set up the model.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewSetUp(User $user)
    {
        return $user->hasAccess('view-set-up-conference-permission');
    }

    /**
     * Determine whether the user can set up the model.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function setUp(User $user)
    {
        return $user->hasAccess('set-up-conference-permission');
    }
}
