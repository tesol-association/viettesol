<?php

namespace App\Http\Controllers\Admin;

use App\ConferenceRepositories\AuthorRepository;
use App\ConferenceRepositories\ReviewAssignmentRepository;
use App\Events\PaperSubmitted;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Author;
use App\Models\ConferenceRole;
use App\Models\PaperAuthor;
use App\ConferenceRepositories\PaperRepository;
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

    public function submission($conferenceId, $paperId, ReviewAssignmentRepository $reviewAssignmentRepository)
    {
        $paper = $this->papers->find($paperId);
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
        $trackDecisions = $this->papers->getTrackDecisions($paperId);
        return view('layouts.admin.paper.submission', [
            'paper' => $paper,
            'reviewers' => $reviewerAccepted,
            'reviewAssignments' => $reviewAssignments,
            'reviewAssignmentIds' => $reviewAssignmentIds,
            'INDEX_ASSIGNMENT' => $INDEX_ASSIGNMENT,
            'reviewForm' => $reviewForm,
            'trackDecisions' => $trackDecisions
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
