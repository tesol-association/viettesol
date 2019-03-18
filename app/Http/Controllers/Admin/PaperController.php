<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Conference;
use App\Models\Paper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaperController extends BaseConferenceController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $conferenceId = $this->conferenceId;
        $papers = Paper::with('track.conference')->get();
        $papers = $papers->filter(function($paper) use ($conferenceId) {
            return $paper->track->conference->id == $conferenceId;
        });
        return view('layouts.admin.paper.list', [
            'papers'=> $papers->all()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $tracks = $this->conference->tracks;
        $sessionTypes = [(object) ["id" => 1, "name" => "POSTER"]];
        $author = Auth::user();
        return view('layouts.admin.paper.create', [
            'tracks' => $tracks,
            'sessionTypes' => $sessionTypes,
            'author' => $author
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
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
