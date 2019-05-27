<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/20/2019
 * Time: 2:54 PM
 */

namespace App\ConferenceRepositories;


use App\Models\ConferenceTimeline;
use App\Models\Error;
use App\Models\Paper;
use App\Models\ReviewAssignment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class ReviewAssignmentRepository
{
    /**
     * @return ReviewForm[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return ReviewAssignment::all();
    }

    public function find($id)
    {
        return ReviewAssignment::with('paper', 'reviewer')->where('id', $id)->first();
    }

    /**
     * @param null $filters
     * @return ReviewAssignment[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get($filters = null)
    {
        if (empty($filters)) {
            $reviewAssignment = ReviewAssignment::with('paper', 'reviewer')->get();
        } else {
            $conditions = [];
            foreach ($filters as $key => $filter) {
                $conditions[] = [$key, '=', $filter];
            }
            $reviewAssignment = ReviewAssignment::with('paper', 'reviewer')->where($conditions)->get();
        }
        return $reviewAssignment;
    }

    public function destroy($id)
    {
        $track = ReviewAssignment::find($id);
        $track->delete();
        return $track;
    }

    /**
     * @param $data
     * @return ReviewAssignment
     * @throws \Exception
     */
    public function assignReviewer($conferenceId, $data)
    {
        $reviewAssignment = new ReviewAssignment();
        $reviewAssignment->paper_id = $data['paper_id'];
        $reviewAssignment->reviewer_id = $data['reviewer_id'];
        $reviewAssignment->date_assigned = Carbon::now();
        $timeline = ConferenceTimeline::where('conference_id', $conferenceId)->first();
        if ($timeline) {
            $reviewAssignment->date_due = $timeline->review_deadline;
        }
        $reviewAssignment->save();
        $reviewAssignment->load('reviewer', 'paper');
        return $reviewAssignment;
    }

    public function autoAssignment($conferenceId, $paper, $reviewerCriterias, ReviewerCriteriaRepository $reviewerCriteriaRepository)
    {
        try {
            foreach ($reviewerCriterias as $reviewerCriteria) {
                $reviewerCriteria->score = 0;
            }
            $paperKeywords = array_map('strtolower', $paper->keywords);
            $track = $paper->track;
//            $papersInTrack = $track->papers;
//            $trackKeywords = [];
//            $keywordInTrack = $papersInTrack->pluck('keywords')->all();
//            foreach ($keywordInTrack as $keywords) {
//                if (is_array($keywords)) {
//                    $trackKeywords = array_merge($trackKeywords, $keywords);
//                }
//            }
//            $trackKeywords = array_map('strtolower', array_unique($trackKeywords));
            $trackKeywords = array_map('strtolower', array_unique($track->keywords));
            $x1 = 10;
            $x2 = (float)(count($paperKeywords) / count($trackKeywords)) * $x1;
            $x3 = 0.5;
            foreach ($reviewerCriterias as $reviewerCriteria) {
                if ($reviewerCriteriaRepository->getSlotUnUsed($conferenceId, $reviewerCriteria) != 0) {
                    $reviewerKeywords = array_map('strtolower', $reviewerCriteria->keywords);
                    $reviewerPaperKeywords = array_intersect($reviewerKeywords, $paperKeywords);
                    if (count($reviewerPaperKeywords)) {
                        $reviewerCriteria->score += $x1 * count($reviewerPaperKeywords);
                    } else {
                        $reviewerTrackKeywords = array_intersect($reviewerKeywords, $trackKeywords);
                        if (count($reviewerTrackKeywords)) {
                            $reviewerCriteria->score += $x2 * count($reviewerTrackKeywords);
                        }
                    }
                }
                if ($reviewerCriteriaRepository->getSlotUsed($conferenceId, $reviewerCriteria) != 0) {
                    $assignments = ReviewAssignment::where('reviewer_id', $reviewerCriteria->user_id)->get();
                    $assignmentInConfences = $assignments->filter(function ($assignment) use ($conferenceId) {
                        return $assignment->paper->track->conference->id == $conferenceId;
                    });
                    foreach ($assignmentInConfences as $assignment) {
                        if (isset($assignment->date_completed) && isset($assignment->date_due)) {
                            if (date('Y-m-d H:i:s', strtotime($assignment->date_completed)) < date('Y-m-d H:i:s', strtotime($assignment->date_due))) {
                                $reviewerCriteria->score += $x3;
                            }
                        }
                    }
                }
            }
            $sortedReviewer = $reviewerCriterias->sortBy('score')->all();
            $reviewerMax = array_pop($sortedReviewer);
            $data = [
                'paper_id' => $paper->id,
                'reviewer_id' => $reviewerMax->user_id,
            ];
            $reviewAssignment = $this->assignReviewer($conferenceId, $data);
            return $reviewAssignment;
        }catch(\Exception $exception) {
            $error = new Error();
            $error->setMessage('No Reviewer. Please choose using Assign Button');
            return $error;
        }
    }

    /**
     * @param $assignId
     * @return mixed
     */
    public function rejectAssignment($assignId)
    {
        $reviewAssignment = ReviewAssignment::find($assignId);
        $reviewAssignment->declined = Config::get('constants.REVIEW_ASSIGNMENT.REJECTED_ASSIGNMENT');
        $reviewAssignment->date_confirmed = Carbon::now();
        $reviewAssignment->save();
        return $reviewAssignment;
    }

    /**
     * @param $assignId
     * @return mixed
     */
    public function acceptAssignment($assignId)
    {
        $reviewAssignment = ReviewAssignment::find($assignId);
        $reviewAssignment->declined = Config::get('constants.REVIEW_ASSIGNMENT.ACCEPTED_ASSIGNMENT');
        $reviewAssignment->date_confirmed = Carbon::now();
        $reviewAssignment->save();
        return $reviewAssignment;
    }

    /**
     * @param $assignId
     * @param $data
     * @return mixed
     */
    public function storeAssignment($assignId, $data)
    {
        $reviewAssignment = ReviewAssignment::find($assignId);
        $reviewAssignment->reviewer_response = $data['review_form'];
        $reviewAssignment->total = $data['total'];
        $reviewAssignment->comment = $data['comment'];
        $reviewAssignment->date_completed = Carbon::now();
        $reviewAssignment->recommendation = $data['recommendation'];
        $reviewAssignment->review_file_id = $data['review_file_id'];
        $reviewAssignment->save();
        return $reviewAssignment;
    }

}
