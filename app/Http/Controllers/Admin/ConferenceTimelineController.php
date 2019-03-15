<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Conference;
use App\Models\ConferenceTimeline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConferenceTimelineController extends BaseConferenceController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view()
    {
        $conference = Conference::find($this->conferenceId);
        $timeline = $conference->timeline;
        return view('layouts.admin.conference_timeline.view', ['conference' => $conference, 'timeline' => $timeline]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('layouts.admin.conference_timeline.create');
    }

    public function store(Request $request)
    {
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->route('admin_timeline_create', ["conference_id" => $this->conferenceId])
                ->withErrors($validator)
                ->withInput();
        }
        $conference = Conference::find($this->conferenceId);
        if ($conference->timeline) {
            return redirect()->route('admin_timeline_create', ["conference_id" => $this->conferenceId])->with('error', 'Timeline exist !');
        } else {
            $timeLine = new ConferenceTimeline();
            $timeLine->conference_id = $this->conferenceId;
            $timeLine->author_registration_opened = $request->author_registration_opened;
            $timeLine->author_registration_closed = $request->author_registration_closed;
            $timeLine->submission_accepted = $request->submission_accepted;
            $timeLine->submission_closed = $request->submission_closed;
            $timeLine->reviewer_registration_opened = $request->reviewer_registration_opened;
            $timeLine->reviewer_registration_closed = $request->reviewer_registration_closed;
            $timeLine->save();
        }
        return redirect()->route('admin_timeline_view', ["conference_id" => $this->conferenceId])->with('success', 'Create Timeline successful !');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($conferenceId, $timeLineId)
    {
        $timeline = ConferenceTimeline::find($timeLineId);
        return view('layouts.admin.conference_timeline.edit', ["timeline" => $timeline]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $conferenceId, $timeLineId)
    {
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->route('admin_timeline_edit', ["conference_id" => $this->conferenceId, "id" => $timeLineId])
                ->withErrors($validator)
                ->withInput();
        }
        $timeLine = ConferenceTimeline::find($timeLineId);
        $timeLine->author_registration_opened = $request->author_registration_opened;
        $timeLine->author_registration_closed = $request->author_registration_closed;
        $timeLine->submission_accepted = $request->submission_accepted;
        $timeLine->submission_closed = $request->submission_closed;
        $timeLine->reviewer_registration_opened = $request->reviewer_registration_opened;
        $timeLine->reviewer_registration_closed = $request->reviewer_registration_closed;
        $timeLine->save();
        return redirect()->route('admin_timeline_view', ["conference_id" => $this->conferenceId])->with('success', 'Update Timeline successful !');
    }


    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($data)
    {
        $conference = Conference::find($this->conferenceId);
        $data["conference_start"] = date('Y-m-d', strtotime($conference->start_time));
        $data["author_registration_opened"] = date('Y-m-d', strtotime($data["author_registration_opened"]));
        $data["author_registration_closed"] = date('Y-m-d', strtotime($data["author_registration_closed"]));
        $data["submission_accepted"] = date('Y-m-d', strtotime($data["submission_accepted"]));
        $data["submission_closed"] = date('Y-m-d', strtotime($data["submission_closed"]));
        $data["reviewer_registration_opened"] = date('Y-m-d', strtotime($data["reviewer_registration_opened"]));
        $data["reviewer_registration_closed"] = date('Y-m-d', strtotime($data["reviewer_registration_closed"]));
        return Validator::make($data, [
            'author_registration_opened' => 'required|date|before:author_registration_closed|before:conference_start',
            'author_registration_closed' => 'required|date|after:author_registration_opened|before:conference_start',
            'submission_accepted' => 'required|date|before:submission_closed|before:conference_start',
            'submission_closed' => 'required|date|after:submission_accepted|before:conference_start',
            'reviewer_registration_opened' => 'required|date|before:reviewer_registration_closed|before:conference_start',
            'reviewer_registration_closed' => 'required|date|after:reviewer_registration_opened|before:conference_start',
        ]);
    }
}
