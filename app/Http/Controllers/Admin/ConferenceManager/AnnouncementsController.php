<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use Illuminate\Validation\Rule;
use App\Models\Announcements;

class AnnouncementsController extends BaseConferenceController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conferenceId)
    {
        $announcements = Announcements::where('conference_id', $conferenceId)->get();
        return view('layouts.admin.conference_manager.announcements.list', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($conferenceId)
    {
        return view('layouts.admin.conference_manager.announcements.create', ['conference_id' => $conferenceId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$request->validate([
    		'title' => ['required', 'string', 'max:255'],
            'expiry_date' => ['required', 'date'],
            'status' => ['required', Rule::in(['draft', 'approved', 'published'])],
    	]);

    	$announcement = new Announcements();
    	$announcement->title = $request->get('title');
    	$announcement->body = $request->get('body');
    	$announcement->conference_id = $this->conferenceId;
    	$announcement->expiry_date = $request->get('expiry_date');
    	$announcement->status = $request->get('status');
    	$announcement->short_content = $request->get('short_content');

    	if ($announcement->save()) {
            return redirect()->route('admin_announcements_list', ['conference_id' => $this->conferenceId])->with('success', 'Announcement has been added successfully');
        } else{
            return redirect()->route('admin_announcements_create', ['conference_id' => $this->conferenceId])->with('errors', 'Error');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($conferenceId, $id)
    {
        $announcement = Announcements::find($id);
        return view('layouts.admin.conference_manager.announcements.edit', ['conference_id' => $this->conferenceId, 'announcement'=>$announcement]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $conferenceId, $id)
    {
    	$request->validate([
    		'title' => ['required', 'string', 'max:255'],
            'expiry_date' => ['required', 'date'],
            'status' => ['required', Rule::in(['draft', 'approved', 'published'])],
    	]);

    	$announcement = Announcements::find($id);
    	$announcement->title = $request->get('title');
    	$announcement->body = $request->get('body');
    	$announcement->expiry_date = $request->get('expiry_date');
    	$announcement->status = $request->get('status');
    	$announcement->short_content = $request->get('short_content');

    	if ($announcement->save()) {
            return redirect()->route('admin_announcements_list', ['conference_id' => $this->conferenceId])->with('success', 'Announcement has been updated successfully');
        } else{
            return redirect()->route('admin_announcements_edit', ['conference_id' => $this->conferenceId, 'announcement'=>$announcement])->with('errors', 'Error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($conferenceId, $id)
    {
        $announcement = Announcements::find($id);

        if ($announcement->delete()) {
            return redirect()->route('admin_announcements_list', ['conference_id' => $this->conferenceId])->with('success', 'Announcement has been deleted successfully');
        } else{
            return redirect()->route('admin_announcements_list', ['conference_id' => $this->conferenceId])->with('errors', 'Error');
        }
    }
}
