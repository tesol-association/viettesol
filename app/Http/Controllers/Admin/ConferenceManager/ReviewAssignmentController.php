<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use App\ConferenceRepositories\PaperRepository;
use App\ConferenceRepositories\ReviewAssignmentRepository;
use App\ConferenceRepositories\TrackRepository;
use App\ConferenceRepositories\PaperFileRepository;
use App\Events\PaperEvent\AssignReviewer;
use App\Events\PaperEvent\Unassigned;
use App\Events\PaperEvent\SendReviewResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

class ReviewAssignmentController extends BaseConferenceController
{
    protected $reviewAssignments;
    protected $tracks;
    protected $papers;
    public function __construct(Request $request, ReviewAssignmentRepository $reviewAssignmentRepository, TrackRepository $trackRepository, PaperRepository $paperRepository, PaperFileRepository $paperFileRepository)
    {
        parent::__construct($request);
        $this->reviewAssignments = $reviewAssignmentRepository;
        $this->tracks = $trackRepository;
        $this->papers = $paperRepository;
        $this->paperFile = $paperFileRepository;
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
        $reviewAssignment = $this->reviewAssignments->assignReviewer($conferenceId,$data);
        event(new AssignReviewer($reviewAssignment));
        return redirect()->route('admin_paper_submission', [
            'conference_id' => $this->conferenceId,
            'paper_id' => $paperId
        ])->with('success', 'Assign Reviewer ' . $reviewAssignment->reviewer->first_name . ' ' . $reviewAssignment->reviewer->last_name . ' successful !');
    }

    public function changeDateDue(Request $request, $conferenceId, $paperId, $reviewAssignmentId)
    {
        $data = $request->all();
        $data["date_due"] = date('Y-m-d', strtotime($data["date_due"]));
        $validator = Validator::make($data, [
            'date_due' => 'required|date',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $reviewAssignment = $this->reviewAssignments->find($reviewAssignmentId);
        $reviewAssignment->date_due = $data['date_due'];
        $reviewAssignment->save();
        return redirect()->route('admin_paper_submission', [
            'conference_id' => $this->conferenceId,
            'paper_id' => $paperId,
        ])->with('success', 'change date due successful !');
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
        $trackDirectors = $paper->track->users;
        $reviewForm = $paper->track->reviewForm;
        if ($reviewForm) {
            $reviewForm = $reviewForm->load('criteriaReviews');
        }
        return view('reviewer.paper.review', [
            'reviewForm' => $reviewForm,
            'paper' => $paper,
            'reviewAssignment' => $reviewAssignment,
            'trackDirectors' => $trackDirectors,
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

        if ($request->hasFile('upload_file')){
            //set path
            $reviewAssignment = $this->reviewAssignments->find($assignmentId);
            $paper = $reviewAssignment->paper;
            $path = 'Conference_'.$conferenceId.'/Reviewer_'.$assignmentId.'/Paper_'.$paper->id;

            //set file name
            $name = $reviewAssignment->reviewer->full_name;
            $fileName = $name.'-'.$request->file('upload_file')->getClientOriginalName();

            //Save attach file
            $path = Storage::disk('public')->putFileAs($path, $request->upload_file, $fileName);

            $riviewerFile['paper_id'] = $paper->id;
            $riviewerFile['revision'] = null;
            $riviewerFile['path'] = $path;
            $riviewerFile['file_type'] = $request->file('upload_file')->getClientOriginalExtension();
            $riviewerFile['file_size'] = $request->file('upload_file')->getSize();
            $riviewerFile['original_file_name'] = $request->file('upload_file')->getClientOriginalName();
            $riviewerFile['type'] = Config::get('constants.PAPER_FILE.REVIEW_FILE');

            //Save paper_file
            $paperFile = $this->paperFile->create($riviewerFile);
            $data['review_file_id'] = $paperFile->id;

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
