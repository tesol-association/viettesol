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
    public function index($conference_id, $building_id)
    {
        $rooms = Rooms::where('building_id', $building_id)->get();
        return view('layouts.admin.conference_manager.rooms.list', ["rooms" => $rooms, 'building_id' =>$building_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($conference_id, $building_id)
    {
        return view('layouts.admin.conference_manager.rooms.create', ["conference_id" => $conference_id, 'building_id' => $building_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $conference_id, $building_id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'abbrev' => ['required', 'string', 'max:45'],
        ]);

        $room = new Rooms([
            'name' => $request->get('name'),
            'abbrev' => $request->get('abbrev'),
            'description' => $request->get('description'),
            'building_id' => $building_id,
        ]);

        if ($room->save()) {
            return redirect()->route('admin_rooms_list', ["conference_id" => $conference_id, 'building_id' => $building_id])->with('success', 'Room has been added successfully');
        } else{
            return redirect()->route('admin_rooms_create',  ["conference_id" => $conference_id, 'building_id' => $building_id])->with('errors', 'Error');
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
    public function edit($conference_id, $building_id, $id)
    {
        $room = Rooms::find($id);

         return view('layouts.admin.conference_manager.rooms.edit', ["room" => $room, "conference_id" => $conference_id, 'building_id' => $building_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $conference_id, $building_id, $id)
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
            return redirect()->route('admin_rooms_list', ["conference_id" => $conference_id, 'building_id' => $building_id])->with('success', 'Room has been update successfully');
        }else{
            return redirect()->route('admin_room_edit', ["conference_id" => $conference_id, 'building_id' => $building_id])->with('errors', 'Error');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($conference_id, $building_id, $id)
    {
        $room = Rooms::find($id);

        if($room->delete()){
            return redirect()->route('admin_rooms_list', ["conference_id" => $conference_id, 'building_id' => $building_id])->with('success', 'Room has been deleted successfully');
        }else{
            return redirect()->route('admin_rooms_list', ["conference_id" => $conference_id, 'building_id' => $building_id])->with('errors', 'Error');
        }
    }
}
