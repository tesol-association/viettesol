<?php

namespace App\Http\Controllers\Admin\ConferenceManager\Reviewer;

use App\ConferenceRepositories\ReviewerCriteriaRepository;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\ReviewCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CriteriaController extends BaseConferenceController
{
    public function show()
    {
        $userId = Auth::id();
        $criteria = ReviewCriteria::where('user_id', $userId)->where('conference_id', $this->conferenceId)->first();
        return view('reviewer.criteria.show', ['criteria' => $criteria]);
    }

    public function store(Request $request)
    {
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $reviewerCriteria = ReviewCriteria::where('user_id', Auth::id)->where('conference_id', $this->conferenceId)->first();
        if ($reviewerCriteria == null) {
            $reviewerCriteria = new ReviewCriteria();
        }
        $reviewerCriteria->slot = $request->slot;
        $reviewerCriteria->keywords = $request->keywords;
        $reviewerCriteria->user_id = Auth::id();
        $reviewerCriteria->conference_id = $this->conferenceId;
        $reviewerCriteria->save();
        return redirect()->route('reviewer_criteria_show', ['conference_id' => $this->conferenceId])->with('success', 'Update criteria successfull !');
    }

    public function validateData($data)
    {
        return Validator::make($data, [
            'slot' => 'numeric',
        ]);
    }
}
