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
        $sessionTypes = SessionType::where('conference_id', $conferenceId)->get();
        return view('layouts.admin.conference_manager.session_type.list', ['conference_id' => $conferenceId, 'sessionTypes' => $sessionTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($conferenceId)
    {
        return view('layouts.admin.conference_manager.session_type.create', ['conference_id' => $conferenceId]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $conferenceId)
    {
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($conferenceId, $id)
    {
        $sessionType = SessionType::find($id);

        return view('layouts.admin.conference_manager.session_type.edit', ['conference_id' => $conferenceId, 'sessionType' => $sessionType]);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($conferenceId, $id)
    {
        $sessionType = SessionType::find($id);

        if($sessionType->delete()){
            return redirect()->route('admin_session_type_list', ["conference_id" => $conferenceId])->with('success', 'Session type has been deleted successfully');
        }else{
            return redirect()->back()->with('errors', 'Error');
        }
    }
}
