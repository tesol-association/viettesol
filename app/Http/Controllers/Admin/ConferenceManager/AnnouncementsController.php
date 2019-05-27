<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use Illuminate\Validation\Rule;
use App\Models\Announcements;

class AnnouncementsController extends BaseConferenceController
{
    /**
     * @param $conferenceId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index($conferenceId)
    {
        $this->authorize('view-announcement');
        $announcements = Announcements::where('conference_id', $conferenceId)->get();
        return view('layouts.admin.conference_manager.announcements.list', compact('announcements'));
    }

    /**
     * @param $conferenceId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create($conferenceId)
    {
        $this->authorize('create-announcement');
        return view('layouts.admin.conference_manager.announcements.create', ['conference_id' => $conferenceId]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create-announcement');
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
     * @param $conferenceId
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($conferenceId, $id)
    {
        $this->authorize('update-announcement');
        $announcement = Announcements::find($id);
        return view('layouts.admin.conference_manager.announcements.edit', ['conference_id' => $this->conferenceId, 'announcement'=>$announcement]);
    }

    /**
     * @param Request $request
     * @param $conferenceId
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $conferenceId, $id)
    {
        $this->authorize('update-announcement');
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
     * @param $conferenceId
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($conferenceId, $id)
    {
        $this->authorize('delete-announcement');
        $announcement = Announcements::find($id);

        if ($announcement->delete()) {
            return redirect()->route('admin_announcements_list', ['conference_id' => $this->conferenceId])->with('success', 'Announcement has been deleted successfully');
        } else{
            return redirect()->route('admin_announcements_list', ['conference_id' => $this->conferenceId])->with('errors', 'Error');
        }
    }
}
