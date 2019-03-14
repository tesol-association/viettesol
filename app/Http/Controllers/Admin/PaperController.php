<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Conference;
use App\Models\Paper;
use Illuminate\Http\Request;

class PaperController extends BaseConferenceController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $conferenceId = $this->conferenceId;
        $papers = Paper::with(['track' => function ($query) use ($conferenceId) {
            $query->where('conference_id', '=', $conferenceId);
        }])->get();
        return view('layouts.admin.paper.list', [
            'papers'=> $papers
        ]);
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
