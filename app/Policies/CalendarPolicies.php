<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CalendarPolicies
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view for paper the model.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewForPaper(User $user)
    {
        return $user->hasAccess('view-calendar-for-paper');
    }

    /**
     * Determine whether the user can view for confernce the model.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewForConference(User $user)
    {
        return $user->hasAccess('view-calendar-for-conference');
    }
}
