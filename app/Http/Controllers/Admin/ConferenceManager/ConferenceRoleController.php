<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\ConferenceRole;

class ConferenceRoleController extends BaseConferenceController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conferenceId)
    {
        $conferenceRoles = ConferenceRole::where('conference_id', $conferenceId)->get();
        return view('layouts.admin.conference_manager.conference_role.list', compact('conferenceRoles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($conferenceId)
    {
        return view('layouts.admin.conference_manager.conference_role.create');
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

        $conferenceRole = new ConferenceRole();
        $conferenceRole->name = $request->get('name');
        $conferenceRole->description = $request->get('description');
        $conferenceRole->conference_id = $conferenceId;

        if ($conferenceRole->save()) {
            return redirect()->route('admin_conference_roles_list', ['conference_id' => $conferenceId])->with('success', 'Conference Role has been added successfully');
        } else{
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
        $conferenceRole = ConferenceRole::find($id);
        return view('layouts.admin.conference_manager.conference_role.edit', compact('conferenceRole'));
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

        $conferenceRole = ConferenceRole::find($id);
        $conferenceRole->name = $request->get('name');
        $conferenceRole->description = $request->get('description');
        
        if ($conferenceRole->save()) {
            return redirect()->route('admin_conference_roles_list', ['conference_id' => $conferenceId])->with('success', 'Conference Role has been updated successfully');
        } else{
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
        $conferenceRole = ConferenceRole::find($id);
        if ($conferenceRole->delete()) {
            return redirect()->route('admin_conference_roles_list', ['conference_id' => $conferenceId])->with('success', 'Conference Role has been deleted successfully');
        } else{
            return redirect()->back()->with('errors', 'Error');
        }
    }
}
