<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/20/2019
 * Time: 2:54 PM
 */

namespace App\ConferenceRepositories;

use App\Models\ReviewForm;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ReviewFormRepository
{
    const UPLOAD_FOLDER = 'review_form';

    /**
     * @return ReviewForm[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return ReviewForm::all();
    }

    public function find($reviewFormId)
    {
        return ReviewForm::find($reviewFormId);
    }

    /**
     * @param null $filters
     * @return ReviewForm[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get($filters = null)
    {
        if (empty($filters)) {
            $reviewForm = ReviewForm::all();
        } else {
            $conditions = [];
            foreach ($filters as $key => $filter) {
                $conditions[] = [$key, '=', $filter];
            }
            $reviewForm = ReviewForm::where($conditions)->get();
        }
        return $reviewForm;
    }

    /**
     * @param $data
     * @return ReviewForm
     */
    public function create($data)
    {
        $reviewForm = new ReviewForm();
        $reviewForm->name = $data['name'];
        $reviewForm->status = $data['status'];
        if (isset($data['attach_file']) && ($data['attach_file'] instanceof UploadedFile)) {
            $url = Storage::disk('public')->put(self::UPLOAD_FOLDER, $data['attach_file']);
            $reviewForm->attach_file = $url;
        }
        $reviewForm->save();
        return $reviewForm;
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $reviewForm = ReviewForm::find($id);
        $reviewForm->name = $data['name'];
        $reviewForm->status = $data['status'];
        if (isset($data['attach_file']) && ($data['attach_file'] instanceof UploadedFile)) {
            $path = Storage::disk('public')->put(self::UPLOAD_FOLDER, $data['attach_file']);
            Storage::disk('public')->delete($reviewForm->attach_file);
            $reviewForm->attach_file = $path;
        }
        $reviewForm->save();
        return $reviewForm;
    }

    public function destroy($id)
    {
        $reviewForm = ReviewForm::find($id);
        foreach ($reviewForm->criteriaReviews as $criteriaReview) {
            $criteriaReview->delete();
        }
        if ($reviewForm->attach_file) {
            Storage::disk('public')->delete($reviewForm->attach_file);
        }
        $reviewForm->delete();
        return $reviewForm;
    }

}
