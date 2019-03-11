<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\CriteriaReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CriteriaReviewController extends BaseConferenceController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $criteriaReviews = CriteriaReview::all();
        return view('layouts.admin.criteria_review.list', [
            'criteriaReviews'=> $criteriaReviews
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('layouts.admin.criteria_review.create');
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
                ->route('admin_criteria_review_create', ['conference_id' => $this->conferenceId])
                ->withErrors($validator)
                ->withInput();
        }
        $criteriaReview = new CriteriaReview();
        $criteriaReview->name = $request->name;
        $criteriaReview->description = $request->description;
        $criteriaReview->possible_values = json_encode(explode(",", $request->possible_values));
        $criteriaReview->save();
        return redirect()->route('admin_criteria_review_list', ['id' => $this->conferenceId])->with('success', 'Create ' . $criteriaReview->name . ' successful !');
    }


    public function edit($conferenceId, $criteriaId)
    {
        $criteriaReview = CriteriaReview::find($criteriaId);
        return view('layouts.admin.criteria_review.edit', ['criteriaReview' => $criteriaReview]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $conferenceId, $criteriaId)
    {
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->route('admin_criteria_review_create', ['conference_id' => $this->conferenceId])
                ->withErrors($validator)
                ->withInput();
        }
        $criteriaReview = CriteriaReview::find($criteriaId);
        $criteriaReview->name = $request->name;
        $criteriaReview->description = $request->description;
        $criteriaReview->possible_values = json_encode(explode(",", $request->possible_values));
        $criteriaReview->save();
        return redirect()->route('admin_criteria_review_list', ['id' => $this->conferenceId])->with('success', 'Update ' . $criteriaReview->name . ' successful !');
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
            'name' => 'required|max:45',
            'possible_values' => 'required',
        ]);
    }
}
