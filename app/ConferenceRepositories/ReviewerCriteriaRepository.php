<?php


namespace App\ConferenceRepositories;


use App\Models\ReviewAssignment;

class ReviewerCriteriaRepository
{
    public function getSlotUsed($conferenceId, $reviewerCriteria)
    {
        $assignments = ReviewAssignment::where('reviewer_id', $reviewerCriteria->user_id)->get();
        $assignmentInConfences = $assignments->filter(function($assignment) use ($conferenceId) {
            return $assignment->paper->track->conference->id == $conferenceId;
        });
        return count($assignmentInConfences);
    }

    public function getSlotUnUsed($conferenceId, $reviewerCriteria) {
        return (int) ($reviewerCriteria->slot) - (int) ($this->getSlotUsed($conferenceId, $reviewerCriteria));
    }
}