<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\ConferenceRole;
use App\Models\User;

class UserConferenceRoleController extends BaseConferenceController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conferenceId)
    {
        $conferenceRoles = ConferenceRole::where('conference_id', $conferenceId)->get();
        $users = User::all();
        foreach ($users as $user) {
            $user->conferenceRoleIds = $user->conferenceRoles->pluck('id')->all();
        }
        return view('layouts.admin.conference_manager.user_conference_role.list', ['conferenceRoles' => $conferenceRoles, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
        $user = User::find($id);
        $data = $request->name;
        $user->conferenceRoles()->detach();
        $user->conferenceRoles()->attach($data);
        
        return redirect()->route('admin_user_conference_roles_list', $conferenceId)->with('success', 'User Conference Role has been update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
