<?php

namespace App\Http\Controllers\Admin\ConferenceManager\TrackDirector;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\ConferenceRepositories\PaperRepository;
use App\ConferenceRepositories\TrackRepository;
use App\ConferenceRepositories\ReviewAssignmentRepository;
use App\Models\ConferenceRole;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

class PaperController extends BaseConferenceController
{
    protected $papers;
    protected $tracks;
    public function __construct(Request $request, PaperRepository $paperRepository, TrackRepository $trackRepository)
    {
        parent::__construct($request);
        $this->papers = $paperRepository;
        $this->tracks = $trackRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conferenceId)
    {
        $trackIds = Auth::user()->tracks->pluck('id')->all();
        $papers = $this->papers->get($conferenceId, ['track_id' => $trackIds]);
        return view('track_director.paper.list', [
            'conference_id' => $this->conferenceId,
            'papers'=> $papers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function submission($conferenceId, $paperId, ReviewAssignmentRepository $reviewAssignmentRepository)
    {
        $paper = $this->papers->find($paperId);
        $users = $paper->track->users->all();
        $reviewForm = $paper->track->reviewForm;
        $reviewForm = $reviewForm->load('criteriaReviews');
        $reviewerRole = ConferenceRole::where('name', ConferenceRole::REVIEWER)->where('conference_id', $this->conferenceId)->first();
        $reviewers = $reviewerRole->user;
        $reviewerAccepted = $reviewers->filter(function ($reviewer) use ($paper) {
            return $reviewer->id !== $paper->submission_by;
        });
        $reviewAssignments = $reviewAssignmentRepository->get(['paper_id' => $paperId]);
        $reviewAssignmentIds = $reviewAssignments->pluck('reviewer_id')->all();
        $INDEX_ASSIGNMENT = Config::get('constants.REVIEW_ASSIGNMENT.INDEX_ASSIGNMENT');
        $trackDecisions = $this->papers->getTrackDecisions($paperId);;
        return view('track_director.paper.submission', [
            'paper' => $paper,
            'reviewers' => $reviewerAccepted,
            'reviewAssignments' => $reviewAssignments,
            'reviewAssignmentIds' => $reviewAssignmentIds,
            'INDEX_ASSIGNMENT' => $INDEX_ASSIGNMENT,
            'reviewForm' => $reviewForm,
            'trackDecisions' => $trackDecisions,
            'users' => $users,
        ]);
    }

    public function decisionAjax(Request $request, $conferenceId, $paperId)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $decision = $this->papers->decision($data);
            return $decision;
        }
        return null;
    }
}
