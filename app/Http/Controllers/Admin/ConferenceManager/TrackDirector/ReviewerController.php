<?php

namespace App\Http\Controllers\Admin\ConferenceManager\TrackDirector;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\ConferenceRepositories\ConferenceRoleRepository;
use App\Models\User;

class ReviewerController extends BaseConferenceController
{
    protected $conferenceRoles;
    public function __construct(Request $request, ConferenceRoleRepository $conferenceRoleRepository)
    {
        parent::__construct($request);
        $this->conferenceRoles = $conferenceRoleRepository;
    }

    public function index($conferenceId)
    {
        $this->authorize('view-reviewer');
        $reviewers = $this->conferenceRoles->getReviewers($conferenceId);
        return view('track_director.reviewer.list', ['conference_id'=>$conferenceId, 'reviewers'=>$reviewers]);
    }
}
