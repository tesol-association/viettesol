<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrePairEmailPolicies
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasAccess('view-prepair-email');
    }

    /**
     * Determine whether the user can sendMail fees.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function send(User $user)
    {
        return $user->hasAccess('send-prepair-email');
    }
}
