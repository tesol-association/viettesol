<?php

namespace App\Http\Controllers\Admin;

use App\ConferenceRepositories\CriteriaReviewRepository;
use App\ConferenceRepositories\ReviewFormRepository;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\CriteriaReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CriteriaReviewController extends BaseConferenceController
{
    protected $criteriaReviews;
    protected $reviewForms;
    public function __construct(Request $request, CriteriaReviewRepository $criteriaReviewRepository, ReviewFormRepository $reviewFormRepository)
    {
        parent::__construct($request);
        $this->criteriaReviews = $criteriaReviewRepository;
        $this->reviewForms = $reviewFormRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($conferenceId, $reviewFormId)
    {
        $reviewForm = $this->reviewForms->find($reviewFormId);
        $criteriaReviews = $this->criteriaReviews->get(['review_form_id' => $reviewFormId]);
        return view('layouts.admin.criteria_review.list', [
            'criteriaReviews'=> $criteriaReviews,
            'reviewForm' => $reviewForm
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($conferenceId, $reviewFormId)
    {
        $reviewForm = $this->reviewForms->find($reviewFormId);
        return view('layouts.admin.criteria_review.create', [
            'reviewForm' => $reviewForm
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $conferenceId, $reviewFormId)
    {
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->route('admin_criteria_review_create', ['conference_id' => $this->conferenceId])
                ->withErrors($validator)
                ->withInput();
        }
        $criteriaReview = $this->criteriaReviews->create($request->all());
        return redirect()
            ->route('admin_criteria_review_list', [
                'conference_id' => $this->conferenceId,
                'review_form_id' => $reviewFormId
            ])
            ->with('success', 'Create ' . $criteriaReview->name . ' successful !');
    }


    public function edit($conferenceId, $reviewFormId, $criteriaId)
    {
        $reviewForm = $this->reviewForms->find($reviewFormId);
        $criteriaReview = $this->criteriaReviews->find($criteriaId);
        return view('layouts.admin.criteria_review.edit', [
            'criteriaReview' => $criteriaReview,
            'reviewForm' => $reviewForm
        ]);
    }


    /**
     * @param Request $request
     * @param $conferenceId
     * @param $reviewFormId
     * @param $criteriaId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $conferenceId, $reviewFormId, $criteriaId)
    {
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->route('admin_criteria_review_edit', ['conference_id' => $this->conferenceId, 'review_form_id' => $reviewFormId, 'id' => $criteriaId])
                ->withErrors($validator)
                ->withInput();
        }
        $criteriaReview = $this->criteriaReviews->update($criteriaId, $request->all());
        return redirect()
            ->route('admin_criteria_review_list', [
                'conference_id' => $this->conferenceId,
                'review_form_id' => $reviewFormId
            ])
            ->with('success', 'Update ' . $criteriaReview->name . ' successful !');
    }

    public function destroy($conferenceId, $reviewFormId, $criteriaId)
    {
        $criteriaReview = $this->criteriaReviews->destroy($criteriaId);
        return redirect()
            ->route('admin_criteria_review_list', [
                'conference_id' => $this->conferenceId,
                'review_form_id' => $reviewFormId
            ])
            ->with('success', 'Delete ' . $criteriaReview->name . ' successful !');
    }
    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($data)
    {
        return Validator::make($data, [
            'review_form_id' => 'required|numeric',
            'name' => 'required|max:45',
            'possible_values' => 'required|array',
        ]);
    }
}
