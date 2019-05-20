<?php

namespace App\Http\Controllers\Admin;

use App\Models\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use App\ConferenceRepositories\TrackRepository;
use App\ConferenceRepositories\PaperRepository;
use App\Models\Announcements;
use App\Models\ConferenceTimeline;

class ConferenceController extends Controller
{
    const UPLOAD_FOLDER = 'conference_overview';
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $conferences = Conference::all();
        return view('layouts.admin.conference.list', ['conferences'=> $conferences]);
    }

    public function view($conferenceId)
    {
        $conference = Conference::find($conferenceId);
        $paperRepository = new PaperRepository();
        $trackRepository = new TrackRepository();

        //paper
        $papers = $paperRepository->get($conferenceId);
        $paperSubmitted = [];
        $paperInReview = [];
        $paperReviewResult = [];
        $paperReJected = [];
        $paperRevision = [];
        $paperAccepted = [];
        $paperUnscheduled = [];
        $paperScheduled = [];
        $paperAuthor = [];
        $paperReviewerNoAnswer = [];
        $paperReviewerAccept = [];
        $paperReviewerReject = [];

        //track
        $tracks = $trackRepository->get(['conference_id'=>$conferenceId]);

        //khai bao author, reviewer, review assignment
        $author = [];
        $reviewer = [];
        $reviewerAssignment = [];
        $reviewerAssignmentUnfinish = [];
        $reviewerAssignmentCompleted = [];
        $reviewerAssignmentDeadlive = [];

        //loop get author, reviewer, review assignment, paper status
        foreach ($papers as $paper) {

            //author
            foreach ($paper->authors as $authors) {
                if($authors->pivot->seq == Config::get('constants.PAPER_AUTHOR.AUTHOR')){
                    if(!in_array($authors->id, array_pluck($author, 'id'))){
                        array_push($author, $authors);
                    }
                    if($authors->id == Auth::id()){
                        array_push($paperAuthor, $paper);
                    }
                }
            }

            //reviewer
            foreach ($paper->reviewers as $reviewers) {
                if(!in_array($reviewers->id, array_pluck($reviewer, 'id'))){
                    array_push($reviewer, $reviewers);
                }
            }

            //review Asignment
            array_push($reviewerAssignment, $paper->reviewAssignment);

            //Review Asignment un finish, completed, deadlive
            foreach ($paper->reviewAssignment as $reviewAssign) {
                if(empty($reviewAssign->date_completed)){
                    array_push($reviewerAssignmentUnfinish, $reviewAssign);
                }else{
                    if($reviewAssign->date_completed > $conference->timeline->review_deadline){
                        array_push($reviewerAssignmentDeadlive, $reviewAssign);
                    }else{
                        array_push($reviewerAssignmentCompleted, $reviewAssign);
                    }
                }

                //Paper Reviwer no answer, accept, reject
                if($reviewAssign->reviewer_id == Auth::id()){
                    if ($reviewAssign->declined == 1) {
                        array_push($paperReviewerReject, $paper);
                    }else{
                        if(empty($reviewAssign->date_confirmed)){
                            array_push($paperReviewerNoAnswer, $paper);
                        }else{
                            array_push($paperReviewerAccept, $paper);
                        }
                    }
                }
            }

            //Paper status
            if($paper->status == Config::get('constants.PAPER_STATUS.SUBMITTED')){
                array_push($paperSubmitted, $paper);
            }
            if($paper->status == Config::get('constants.PAPER_STATUS.IN_REVIEW')){
                array_push($paperInReview, $paper);
            }
            if($paper->status == Config::get('constants.PAPER_STATUS.ALL_REVIEWER_RECOMMENDATION')){
                array_push($paperReviewResult, $paper);
            }
            if($paper->status == Config::get('constants.PAPER_STATUS.ACCEPTED')){
                array_push($paperAccepted, $paper);
            }
            if($paper->status == Config::get('constants.PAPER_STATUS.REJECTED')){
                array_push($paperReJected, $paper);
            }
            if($paper->status == Config::get('constants.PAPER_STATUS.REVISION')){
                array_push($paperRevision, $paper);
            }
            if($paper->status == Config::get('constants.PAPER_STATUS.UNSCHEDULED')){
                array_push($paperUnscheduled, $paper);
            }
            if($paper->status == Config::get('constants.PAPER_STATUS.SCHEDULED')){
                array_push($paperScheduled, $paper);
            }
        }

        //announcements
        $announcements = Announcements::where('conference_id', $conferenceId)->get();

        //Time line
        $timeLine = ConferenceTimeline::where('conference_id', $conferenceId)->first();

        return view('layouts.admin.conference.view', [
            'conference'=> $conference,
            'papers'=>$papers,
            'tracks'=>$tracks,
            'author'=>$author,
            'reviewer'=>$reviewer,
            'reviewerAssignment'=>$reviewerAssignment,
            'announcements'=>$announcements,
            'paperSubmitted'=>$paperSubmitted,
            'paperInReview'=>$paperInReview,
            'paperReviewResult'=>$paperReviewResult,
            'paperAccepted'=>$paperAccepted,
            'paperReJected'=>$paperReJected,
            'paperRevision'=>$paperRevision,
            'paperUnscheduled'=>$paperUnscheduled,
            'paperScheduled'=>$paperScheduled,
            'timeLine'=>$timeLine,
            'reviewerAssignmentUnfinish'=>$reviewerAssignmentUnfinish,
            'reviewerAssignmentCompleted'=>$reviewerAssignmentCompleted,
            'reviewerAssignmentDeadlive'=>$reviewerAssignmentDeadlive,
            'paperAuthor'=>$paperAuthor,
            'paperReviewerAccept'=>$paperReviewerAccept,
            'paperReviewerReject'=>$paperReviewerReject,
            'paperReviewerNoAnswer'=>$paperReviewerNoAnswer,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('layouts.admin.conference.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->route('admin_conference_create')
                ->withErrors($validator)
                ->withInput();
        }
        $conference = new Conference();
        $conference->slogan = $request->slogan;
        $conference->title = $request->title;
        $conference->path = $request->path;
        $conference->start_time = new \DateTime($request->start_time);
        $conference->end_time = new \DateTime($request->end_time);
        $conference->venue = $request->venue;
        $conference->description = $request->description;
        if ($request->hasFile('attach_file')) {
            $url = Storage::disk('public')->put(self::UPLOAD_FOLDER, $request->attach_file);
            $conference->attach_file = $url;
        }
        $conference->save();
        return redirect()->route('admin_conference_list')->with('success', 'Create ' . $conference->title . ' successful !');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $conference = Conference::find($id);
        return view('layouts.admin.conference.edit', ['conference' => $conference]);
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data["id"] = $id;
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->route('admin_conference_edit', ["id" => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $conference = Conference::find($id);
        if ($request->hasFile('attach_file')) {
            $path = Storage::disk('public')->put(self::UPLOAD_FOLDER, $request->attach_file);
            Storage::disk('public')->delete($conference->attach_file);
            $conference->attach_file = $path;
        }
        $conference->slogan = $request->slogan;
        $conference->title = $request->title;
        $conference->path = $request->path;
        $conference->start_time = new \DateTime($request->start_time);
        $conference->end_time = new \DateTime($request->end_time);
        $conference->venue = $request->venue;
        $conference->description = $request->description;
        $conference->save();
        return redirect()->route('admin_conference_list')->with('success', 'Update ' . $conference->title . ' successful !');
    }

    public function destroy($id)
    {
        $conference = Conference::find($id);
//        Conference::destroy($id);
//        return redirect()->route('admin_conference_list')->with('success','Delete ' . $conference->title . ' successfully !');
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($data)
    {
        $data["start_time"] = date('Y-m-d', strtotime($data["start_time"]));
        $data["end_time"] = date('Y-m-d', strtotime($data["end_time"]));
        $id = isset($data["id"]) && $data["id"] ? $data["id"] : null;
        return Validator::make($data, [
            'slogan' => 'required',
            'title' => 'required',
            'path' => 'required|unique:conferences,path,' . $id,
            'venue' => 'required',
            'start_time' => 'required|date|before:end_time',
            'end_time' => 'required|date|after:start_time',
        ]);
    }

}
