<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\SessionType;

class SessionTypeController extends BaseConferenceController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conferenceId)
    {
        $this->authorize('view-session-type');
        $sessionTypes = SessionType::where('conference_id', $conferenceId)->get();
        return view('layouts.admin.conference_manager.session_type.list', ['conference_id' => $conferenceId, 'sessionTypes' => $sessionTypes]);
    }

    /**
     * @param $conferenceId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create($conferenceId)
    {
        $this->authorize('create-session-type');
        return view('layouts.admin.conference_manager.session_type.create', ['conference_id' => $conferenceId]); 
    }

    /**
     * @param Request $request
     * @param $conferenceId
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, $conferenceId)
    {
        $this->authorize('create-session-type');
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $sessionType = new SessionType();

        $sessionType->name = $request->get('name');
        $sessionType->description = $request->get('description');
        $sessionType->length = $request->get('length');
        $sessionType->abstract_length = $request->get('abstract_length');
        $sessionType->conference_id = $conferenceId;

        if($sessionType->save()){
            return redirect()->route('admin_session_type_list', ["conference_id" => $conferenceId])->with('success', 'Session type has been add successfully');
        }else{
            return redirect()->back()->with('errors', 'Error');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $conferenceId
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($conferenceId, $id)
    {
        $this->authorize('update-session-type');
        $sessionType = SessionType::find($id);

        return view('layouts.admin.conference_manager.session_type.edit', ['conference_id' => $conferenceId, 'sessionType' => $sessionType]);
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
        $this->authorize('update-session-type');
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $sessionType = SessionType::find($id);

        $sessionType->name = $request->get('name');
        $sessionType->description = $request->get('description');
        $sessionType->length = $request->get('length');
        $sessionType->abstract_length = $request->get('abstract_length');

        if($sessionType->save()){
            return redirect()->route('admin_session_type_list', ["conference_id" => $conferenceId])->with('success', 'Session type has been update successfully');
        }else{
            return redirect()->back()->with('errors', 'Error');
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
        $this->authorize('delete-session-type');
        $sessionType = SessionType::find($id);

        if($sessionType->delete()){
            return redirect()->route('admin_session_type_list', ["conference_id" => $conferenceId])->with('success', 'Session type has been deleted successfully');
        }else{
            return redirect()->back()->with('errors', 'Error');
        }
    }
}
