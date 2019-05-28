<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewFormPolicies
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasAccess('view-review-form');
    }

    /**
     * Determine whether the user can create review forms.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess('create-review-form');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->hasAccess('update-review-form');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasAccess('delete-review-form');
    }

}
