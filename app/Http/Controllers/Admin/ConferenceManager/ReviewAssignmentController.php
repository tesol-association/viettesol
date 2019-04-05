<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use App\ConferenceRepositories\PaperRepository;
use App\ConferenceRepositories\ReviewAssignmentRepository;
use App\ConferenceRepositories\TrackRepository;
use App\Events\PaperEvent\AssignReviewer;
use App\Events\PaperEvent\Unassigned;
use App\Events\PaperEvent\SendReviewResult;
use App\Models\Paper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewAssignmentController extends BaseConferenceController
{
    protected $reviewAssignments;
    protected $tracks;
    public function __construct(Request $request, ReviewAssignmentRepository $reviewAssignmentRepository, TrackRepository $trackRepository)
    {
        parent::__construct($request);
        $this->reviewAssignments = $reviewAssignmentRepository;
        $this->tracks = $trackRepository;
    }

    public function index()
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request, $conferenceId, $paperId)
    {
        $data = $request->all();
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->route('admin_paper_submission', ['conference_id' => $this->conferenceId, 'paper_id' => $paperId])
                ->withErrors($validator)
                ->withInput();
        }
        $reviewAssignment = $this->reviewAssignments->assignReviewer($data);
        event(new AssignReviewer($reviewAssignment));
        return redirect()->route('admin_paper_submission', [
            'conference_id' => $this->conferenceId,
            'paper_id' => $paperId
        ])->with('success', 'Assign Reviewer ' . $reviewAssignment->reviewer->first_name . ' ' . $reviewAssignment->reviewer->last_name . ' successful !');
    }

    public function edit($id)
    {
    }


    public function update(Request $request, $conferenceId, $id)
    {
    }

    public function destroy($conferenceId, $id)
    {
        $reviewAssignment = $this->reviewAssignments->destroy($id);
        event(new Unassigned($reviewAssignment));
        return redirect()->back()->with('success', 'Review Assignment '.$reviewAssignment->reviewer->first_name.$reviewAssignment->reviewer->last_name .' has been deleted successful');
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($data)
    {
        return Validator::make($data, [
            'paper_id' => 'required|numeric',
            'reviewer_id' => 'required|numeric',
        ]);
    }

    /**
     * LIST PAPER FOR REVIEWER
     */
    public function showPaperList()
    {
        $confenceId = $this->conferenceId;
        $reviewId = Auth::user()->id;
        $reviewAssignments = $this->reviewAssignments->get(['reviewer_id' => $reviewId]);
        $tracks = $this->tracks->get(['conference_id' => $confenceId]);
        $trackList = $tracks->pluck('id')->all();

        //get assignment in Conference
        $reviewAssignments = $reviewAssignments->filter(function($reviewAssignment) use ($trackList) {
            return in_array($reviewAssignment->paper->track_id, $trackList);
        });
        return view('reviewer.paper.list', [
            'reviewAssignments' => $reviewAssignments,
        ]);
    }

    /**
     * SHOW PAPER LIST FOR REVIEWER
     * @param $conferenceId
     * @param $assignmentId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAssignment($conferenceId, $assignmentId, PaperRepository $paperRepository)
    {
        $reviewAssignment = $this->reviewAssignments->find($assignmentId);
        $paper = $paperRepository->find($reviewAssignment->paper_id);
        $reviewForm = $paper->track->reviewForm;
        $reviewForm = $reviewForm->load('criteriaReviews');
        return view('reviewer.paper.review', [
            'reviewForm' => $reviewForm,
            'paper' => $paper,
            'reviewAssignment' => $reviewAssignment,
        ]);
    }

    /**
     * @param Request $request
     * @param $conferenceId
     * @param $assignmentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAssignment(Request $request, $conferenceId, $assignmentId)
    {
        $data = $request->all();
        $validator = $this->validateAssignment($data);
        if ($validator->fails()) {
            return redirect()
                ->route('reviewer_do_review', ['conference_id' => $this->conferenceId, 'assignment_id' => $assignmentId])
                ->withErrors($validator)
                ->withInput();
        }
        $reviewAssignment = $this->reviewAssignments->storeAssignment($assignmentId, $data);
        event(new SendReviewResult($reviewAssignment));
        return redirect()->route('reviewer_paper_list', [
            "conference_id" => $this->conferenceId
        ])->with('success', 'Assignment: ' . $reviewAssignment->title . ' done !');
    }

    public function validateAssignment($data)
    {
        return Validator::make($data, [
            'total' => 'required|numeric',
        ]);
    }

    /**
     * @param $conferenceId
     * @param $assignmentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rejectAssignment($conferenceId, $assignmentId)
    {
        $reviewAssignment = $this->reviewAssignments->rejectAssignment($assignmentId);
        return redirect()->route('reviewer_paper_list', [
            "conference_id" => $this->conferenceId
        ])->with('success', 'Reject ' . $reviewAssignment->title . ' successful !');
    }

    /**
     * @param $conferenceId
     * @param $assignmentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptAssignment($conferenceId, $assignmentId)
    {
        $reviewAssignment = $this->reviewAssignments->acceptAssignment($assignmentId);
        return redirect()->route('reviewer_do_review', [
            "conference_id" => $this->conferenceId,
            "assignment_id" => $reviewAssignment->id,
        ])->with('success', 'Accepted ' . $reviewAssignment->title . ' successful !');
    }

    public function save(Request $request, $conferenceId, $paperId)
    {
        $data = $request->all();
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->route('admin_paper_submission', ['conference_id' => $this->conferenceId, 'paper_id' => $paperId])
                ->withErrors($validator)
                ->withInput();
        }
        $reviewAssignment = $this->reviewAssignments->assignReviewer($data);
        return redirect()->route('track_director_paper_submission', [
            'conference_id' => $this->conferenceId,
            'paper_id' => $paperId
        ])->with('success', 'Assign Reviewer ' . $reviewAssignment->reviewer->first_name . ' ' . $reviewAssignment->reviewer->last_name . ' successful !');
    }

}
