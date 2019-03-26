<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/20/2019
 * Time: 2:54 PM
 */

namespace App\ConferenceRepositories;


use App\Models\ReviewAssignment;
use Carbon\Carbon;

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
        return ReviewAssignment::find($id);
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

    /**
     * @param $data
     * @return ReviewAssignment
     * @throws \Exception
     */
    public function assignReviewer($data)
    {
        $reviewAssignment = new ReviewAssignment();
        $reviewAssignment->paper_id = $data['paper_id'];
        $reviewAssignment->reviewer_id = $data['reviewer_id'];
        $reviewAssignment->date_assigned = Carbon::now();
        $reviewAssignment->save();
        $reviewAssignment->load('reviewer');
        return $reviewAssignment;
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $track = ReviewAssignment::find($id);
        $track->name = $data['name'];
        $track->abbrev = $data['abbrev'];
        $track->policy = $data['policy'];
        $track->description = $data['description'];
        $track->review_form_id = $data['review_form_id'];
        $track->save();
        return $track;
    }

    public function destroy($id)
    {
        $track = ReviewAssignment::find($id);
        $track->delete();
        return $track;
    }

}
