<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Conference;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrackController extends BaseConferenceController
{
    /**
     * @param $conferenceId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($conferenceId)
    {
        $conference = Conference::find($conferenceId);
        $tracks = $conference->tracks;
        return view('layouts.admin.track.list', [
            'tracks'=> $tracks
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('layouts.admin.track.create');
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
        $track = new Track();
        $track->fill($data);
        $track->save();
        return redirect()->route('admin_track_list', ['id' => $request->conference_id])->with('success', 'Create ' . $track->name . ' successful !');
    }

    /**
     * @param $conferenceId
     * @param $trackId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($conferenceId, $trackId)
    {
        $track = Track::find($trackId);
        return view('layouts.admin.track.edit', ['track' => $track]);
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
        $track = Track::find($trackId);
        $track->name = $request->name;
        $track->abbrev = $request->abbrev;
        $track->policy = $request->policy;
        $track->description = $request->description;
        $track->save();
        return redirect()->route('admin_track_list', ['id' => $request->conference_id])->with('success', 'Update ' . $track->name . ' successful !');
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
            'name' => 'required|max:45',
            'abbrev' => 'required|max:45',
        ]);
    }

}
