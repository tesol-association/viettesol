<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Buildings;
use App\Models\Rooms;

class BuildingsController extends BaseConferenceController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings = Buildings::where('conference_id', $this->conferenceId)->get();
        return view('layouts.admin.conference_manager.buildings.list', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin.conference_manager.buildings.create');
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
            'name' => ['required', 'string', 'max:255'],
            'abbrev' => ['required', 'string', 'max:45'],
        ]);

        $building = new Buildings([
            'name' => $request->get('name'),
            'abbrev' => $request->get('abbrev'),
            'description' => $request->get('description'),
            'conference_id' => $conferenceId,
        ]);

        if ($building->save()) {
            return redirect()->route('admin_buildings_list', $conferenceId)->with('success', 'Building has been added successfully');
        } else{
            return redirect()->route('admin_buildings_create', $conferenceId)->with('errors', 'Error');
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
        $building = Buildings::find($id);
        return view('layouts.admin.conference_manager.buildings.edit', ['building' => $building]);
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
            'name' => ['required', 'string', 'max:255'],
            'abbrev' => ['required', 'string', 'max:45'],
        ]);

        $building = Buildings::find($id);

        $building->name = $request->get('name');
        $building->abbrev = $request->get('abbrev');
        $building->description = $request->get('description');

        if($building->save()){
            return redirect()->route('admin_buildings_list', $conferenceId)->with('success', 'Building has been update successfully');
        }else{
            return redirect()->route('admin_buildings_edit', $building)->with('errors', 'Error');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $conferenceId, $id)
    {
        $building = Buildings::find($id);
        foreach ($building->rooms as $room) {
            $room->delete();
        }
        
        if(!$building->delete()){
            return redirect()->route('admin_buildings_list', $conferenceId)->with('errors', 'Error');
        }
        
        return redirect()->route('admin_buildings_list', $conferenceId)->with('success', 'Building has been deleted successfully');
    }
}
