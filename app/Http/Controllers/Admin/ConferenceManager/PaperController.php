<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use App\ConferenceRepositories\AuthorRepository;
use App\ConferenceRepositories\ConferenceRoleRepository;
use App\ConferenceRepositories\PaperEventLogRepository;
use App\ConferenceRepositories\ReviewAssignmentRepository;
use App\Events\PaperSubmitted;
use App\Events\PaperEvent\TrackDecided;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Author;
use App\Models\PaperAuthor;
use App\ConferenceRepositories\PaperRepository;
use App\ConferenceRepositories\TrackDecisionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class PaperController extends BaseConferenceController
{
    protected $papers;
    protected $authors;
    public function __construct(Request $request, PaperRepository $paperRepository, AuthorRepository $authorRepository)
    {
        parent::__construct($request);
        $this->papers = $paperRepository;
        $this->authors = $authorRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('view-paper');
        $conferenceId = $this->conferenceId;
        $papers = $this->papers->get($conferenceId);
        return view('layouts.admin.paper.list', [
            'papers'=> $papers
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('send-paper');
        $tracks = $this->conference->tracks;
        $sessionTypes = $this->conference->sessionTypes;
        $author = Auth::user();
        return view('layouts.admin.paper.create', [
            'tracks' => $tracks,
            'sessionTypes' => $sessionTypes,
            'author' => $author
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('send-paper');
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->route('admin_paper_create', ['id' => $this->conferenceId])
                ->withErrors($validator)
                ->withInput();
        }
        $authorDatas = $request->authors;
        $paperData = $request->paper;
        $paper = $this->papers->createSubmittedPaper($paperData);
        event(new PaperSubmitted($paper));
        foreach ($authorDatas as $seq => $authorData) {
            $author = Author::where('email', $authorData['email'])->first();
            if (empty($author)) {
                $author = $this->authors->create($authorData);
            }
            $paperAuthor = new PaperAuthor();
            $paperAuthor->paper_id = $paper->id;
            $paperAuthor->author_id = $author->id;
            $paperAuthor->seq = $seq;
            $paperAuthor->save();
        }
        return redirect()->route('admin_paper_list', ["conference_id" => $this->conferenceId])->with('success', 'Submission ' . $paper->title . ' successful !');
    }

    public function submission($conferenceId, $paperId, ReviewAssignmentRepository $reviewAssignmentRepository, ConferenceRoleRepository $conferenceRoleRepository, PaperEventLogRepository $paperEventLogRepository)
    {
        $paper = $this->papers->find($paperId);
        $trackDirectors = $paper->track->users->all(); //get Track Directors
        $reviewForm = $paper->track->reviewForm;
        $reviewers = $conferenceRoleRepository->getReviewers($this->conferenceId);
        $reviewerAccepted = $reviewers->filter(function ($reviewer) use ($paper) {
            return $reviewer->id !== $paper->submission_by;
        });
        $reviewAssignments = $reviewAssignmentRepository->get(['paper_id' => $paperId]);
        $reviewAssignmentIds = $reviewAssignments->pluck('reviewer_id')->all();
        $trackDecisions = $this->papers->getTrackDecisions($paperId);
        $INDEX_ASSIGNMENT = Config::get('constants.REVIEW_ASSIGNMENT.INDEX_ASSIGNMENT');
        $paperHistories = $paperEventLogRepository->get(['paper_id' => $paperId]);
        return view('layouts.admin.paper.submission', [
            'paper' => $paper,
            'reviewers' => $reviewerAccepted,
            'reviewAssignments' => $reviewAssignments,
            'reviewAssignmentIds' => $reviewAssignmentIds,
            'INDEX_ASSIGNMENT' => $INDEX_ASSIGNMENT,
            'reviewForm' => $reviewForm,
            'trackDecisions' => $trackDecisions,
            'users' => $trackDirectors,
            'paperHistories' => $paperHistories,
        ]);
    }

    public function decisionAjax(Request $request, $conferenceId, $paperId, TrackDecisionRepository $trackDecisionRepository)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $decision = $trackDecisionRepository->create($data);
            event(new TrackDecided($decision));
            return $decision;
        }
        return null;
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($data)
    {
        return Validator::make($data, [
            'paper.track_id' => 'required|numeric',
            'paper.session_type_id' => 'required|numeric',
            'paper.title' => 'required',
            'paper.abstract' => 'required',
            'authors.*.first_name' => 'required',
            'authors.*.last_name' => 'required',
            'authors.*.email' => 'required',
            'authors.*.affiliation' => 'required',
        ]);
    }
}
