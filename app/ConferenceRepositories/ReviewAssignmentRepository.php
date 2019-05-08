<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/20/2019
 * Time: 2:54 PM
 */

namespace App\ConferenceRepositories;


use App\Models\ConferenceTimeline;
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
