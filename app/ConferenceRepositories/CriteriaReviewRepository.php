<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/20/2019
 * Time: 4:03 PM
 */

namespace App\ConferenceRepositories;

use App\Models\CriteriaReview;

class CriteriaReviewRepository
{
    public function get($filters = null)
    {
        if (empty($filters)) {
            $criteriaReviews = CriteriaReview::with('reviewForm')->get();
        } else {
            $conditions = [];
            foreach ($filters as $key => $filter) {
                $conditions[] = [$key, '=', $filter];
            }
            $criteriaReviews = CriteriaReview::with('reviewForm')->where($conditions)->get();
        }

        return $criteriaReviews;
    }

    public function all()
    {
        return CriteriaReview::with('reviewForm')->get();
    }

    public function find($criteriaId)
    {
        $criteriaReview =  CriteriaReview::find($criteriaId);
        return $criteriaReview;
    }

    /**
     * @param $data
     * @return CriteriaReview
     */
    public function create(array $data)
    {
        $criteria = new CriteriaReview();
        $criteria->review_form_id = $data['review_form_id'];
        $criteria->name = $data['name'];
        $criteria->description = $data['description'];
        $criteria->possible_values = $data['possible_values'];
        $criteria->save();
        return $criteria;
    }

    /**
     * @param $criteriaId
     * @param $data
     * @return mixed
     */
    public function update($criteriaId, array $data)
    {
        $criteria = CriteriaReview::find($criteriaId);
        $criteria->review_form_id = $data['review_form_id'];
        $criteria->name = $data['name'];
        $criteria->description = $data['description'];
        $criteria->possible_values = $data['possible_values'];
        $criteria->save();
        return $criteria;
    }

    public function destroy($criteriaId)
    {
        $criteriaReview = CriteriaReview::find($criteriaId);
        $criteriaReview->delete();
        return $criteriaReview;
    }
}
