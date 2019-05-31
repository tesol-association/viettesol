<?php

namespace App\Policies;

use App\Models\Paper;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaperPolicies
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the paper.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Paper  $paper
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->hasAccess('view-paper');
    }

    /**
     * Determine whether the user can create papers.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function sendPaper(User $user)
    {
        return $user->hasAccess('send-paper');
    }

    /**
     * Determine whether the user can update the paper.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Paper  $paper
     * @return mixed
     */
    public function update(User $user, Paper $paper)
    {
        return $user->id == $paper->submission_by;
    }

    /**
     * Determine whether the user can delete the paper.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewPaperUnSchedule(User $user)
    {
        return $user->hasAccess('view-paper-un-schedule');
    }
}
