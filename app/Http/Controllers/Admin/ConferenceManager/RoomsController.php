<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Rooms;
use App\Models\Buildings;

class RoomsController extends BaseConferenceController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conferenceId, $buildingId)
    {
        $building = Buildings::find($buildingId);
        $rooms = Rooms::where('building_id', $buildingId)->get();
        return view('layouts.admin.conference_manager.rooms.list', ["rooms" => $rooms, 'building_id' =>$buildingId, 'building'=>$building]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($conferenceId, $buildingId)
    {
        return view('layouts.admin.conference_manager.rooms.create', ["conference_id" => $conferenceId, 'building_id' => $buildingId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $conferenceId, $buildingId)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'abbrev' => ['required', 'string', 'max:45'],
        ]);

        $room = new Rooms([
            'name' => $request->get('name'),
            'abbrev' => $request->get('abbrev'),
            'description' => $request->get('description'),
            'building_id' => $buildingId,
        ]);

        if ($room->save()) {
            return redirect()->route('admin_rooms_list', ["conference_id" => $conferenceId, 'building_id' => $buildingId])->with('success', 'Room has been added successfully');
        } else{
            return redirect()->route('admin_rooms_create',  ["conference_id" => $conferenceId, 'building_id' => $buildingId])->with('errors', 'Error');
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
    public function edit($conferenceId, $buildingId, $id)
    {
        $room = Rooms::find($id);

         return view('layouts.admin.conference_manager.rooms.edit', ["room" => $room, "conference_id" => $conferenceId, 'building_id' => $buildingId]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $conferenceId, $buildingId, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'abbrev' => ['required', 'string', 'max:45'],
        ]);

        $room = Rooms::find($id);

        $room->name = $request->get('name');
        $room->abbrev = $request->get('abbrev');
        $room->description = $request->get('description');

        if($room->save()){
            return redirect()->route('admin_rooms_list', ["conference_id" => $conferenceId, 'building_id' => $buildingId])->with('success', 'Room has been update successfully');
        }else{
            return redirect()->route('admin_room_edit', ["conference_id" => $conferenceId, 'building_id' => $buildingId])->with('errors', 'Error');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($conferenceId, $buildingId, $id)
    {
        $room = Rooms::find($id);

        if($room->delete()){
            return redirect()->route('admin_rooms_list', ["conference_id" => $conferenceId, 'building_id' => $buildingId])->with('success', 'Room has been deleted successfully');
        }else{
            return redirect()->route('admin_rooms_list', ["conference_id" => $conferenceId, 'building_id' => $buildingId])->with('errors', 'Error');
        }
    }
}