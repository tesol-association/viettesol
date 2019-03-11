<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\CriteriaReview;
use App\Models\ReviewForm;
use App\Models\ReviewFormSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReviewFormController extends BaseConferenceController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $reviewForms = ReviewForm::all();
        return view('layouts.admin.review_form.list', [
            'reviewForms'=> $reviewForms
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $criterias = CriteriaReview::all();
        return view('layouts.admin.review_form.create', ['criterias' => $criterias]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->route('admin_review_form_create', ['conference_id' => $this->conferenceId])
                ->withErrors($validator)
                ->withInput();
        }
        $reviewForm = new ReviewForm();
        $reviewForm->name = $request->name;
        $reviewForm->status = $request->status;
        $reviewForm->save();
        foreach ($request->criteria as $criteriaId) {
            $reviewFormSetting = new ReviewFormSetting();
            $reviewFormSetting->review_form_id = $reviewForm->id;
            $reviewFormSetting->criteria_review_id = $criteriaId;
            $reviewFormSetting->save();
        }
        return redirect()->route('admin_review_form_list', ['id' => $this->conferenceId])->with('success', 'Create ' . $reviewForm->name . ' successful !');
    }

    /**
     * @param $conferenceId
     * @param $reviewFormId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($conferenceId, $reviewFormId)
    {
        $criterias = CriteriaReview::all();
        $reviewForm = ReviewForm::find($reviewFormId);
        $criteriaSelected = [];
        foreach ($reviewForm->reviewCriteriaLink as $reviewCriteria) {
            $criteriaSelected[] = $reviewCriteria->criteria_review_id;
        }
        return view('layouts.admin.review_form.edit', ['reviewForm' => $reviewForm, 'criterias' => $criterias, 'criteriaSelected' => $criteriaSelected]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $conferenceId, $criteriaId)
    {
    }

    public function destroy()
    {

    }
    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'criteria' => 'required',
            'status' => ["required", Rule::in(["active", "inactive"])],
        ]);
    }
}
