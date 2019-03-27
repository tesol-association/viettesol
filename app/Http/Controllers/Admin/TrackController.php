<?php

namespace App\Http\Controllers\Admin;

use App\ConferenceRepositories\ReviewFormRepository;
use App\ConferenceRepositories\TrackRepository;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Conference;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrackController extends BaseConferenceController
{
    protected $tracks;
    protected $reviewForms;
    public function __construct(Request $request, TrackRepository $trackRepository, ReviewFormRepository $reviewFormRepository)
    {
        parent::__construct($request);
        $this->tracks = $trackRepository;
        $this->reviewForms = $reviewFormRepository;
    }

    /**
     * @param $conferenceId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($conferenceId)
    {
        $tracks = $this->tracks->get(['conference_id' => $conferenceId]);
        return view('layouts.admin.track.list', [
            'tracks'=> $tracks
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $reviewForms = $this->reviewForms->all();
        return view('layouts.admin.track.create', [
            'reviewForms' => $reviewForms
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->route('admin_track_create', ['conference_id' => $request->conference_id])
                ->withErrors($validator)
                ->withInput();
        }
        $track = $this->tracks->create($data);
        return redirect()->route('admin_track_list', ['id' => $request->conference_id])->with('success', 'Create ' . $track->name . ' successful !');
    }

    /**
     * @param $conferenceId
     * @param $trackId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($conferenceId, $trackId)
    {
        $track = $this->tracks->find($trackId);
        $reviewForms = $this->reviewForms->all();
        return view('layouts.admin.track.edit', [
            'track' => $track,
            'reviewForms' => $reviewForms
        ]);
    }

    /**
     * @param Request $request
     * @param $conferenceId
     * @param $trackId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $conferenceId, $trackId)
    {
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->route('admin_track_edit', ['id' => $request->conference_id])
                ->withErrors($validator)
                ->withInput();
        }
        $track = $this->tracks->update($trackId, $request->all());
        return redirect()->route('admin_track_list', ['id' => $this->conferenceId])->with('success', 'Update ' . $track->name . ' successful !');
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
            'conference_id' => 'required|numeric',
            'name' => 'required|max:45',
            'abbrev' => 'required|max:45',
        ]);
    }

}
