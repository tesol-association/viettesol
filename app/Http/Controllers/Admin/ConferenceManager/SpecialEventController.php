<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\SpecialEvent;
use App\Models\Rooms;

class SpecialEventController extends BaseConferenceController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conferenceId)
    {
        $this->authorize('view-special-event');
        $specialEvents = SpecialEvent::where('conference_id', $conferenceId)->get();
        return view('layouts.admin.conference_manager.special_event.list', ['conference_id' => $conferenceId, 'specialEvents' => $specialEvents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($conferenceId)
    {
        $this->authorize('create-special-event');
        $rooms = Rooms::with('building.conference')->get();
        $rooms = $rooms->filter(function($room) use ($conferenceId) {
            return $room->building->conference->id == $conferenceId;
        });
        return view('layouts.admin.conference_manager.special_event.create', ['conference_id' => $conferenceId, 'rooms' => $rooms]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $conferenceId)
    {
        $this->authorize('create-special-event');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i', 'before:end_time'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time']
        ]);

        $specialEvent = new SpecialEvent();

        $specialEvent->name = $request->get('name');
        $specialEvent->date = $request->get('date');
        $specialEvent->start_time = $request->get('start_time');
        $specialEvent->end_time = $request->get('end_time');
        $specialEvent->room_id = $request->get('room_id');
        $specialEvent->description = $request->get('description');
        $specialEvent->conference_id = $conferenceId;

        if($specialEvent->save()){
            return redirect()->route('admin_special_event_list', ['conference_id' => $conferenceId])->with('success', 'Special Event has been add successfully');
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
        $this->authorize('update-special-event');
        $specialEvent = SpecialEvent::find($id);
        $rooms = Rooms::all();
        return view('layouts.admin.conference_manager.special_event.edit', ['conference_id' => $conferenceId, 'specialEvent' => $specialEvent, 'rooms' => $rooms]);
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
        $this->authorize('update-special-event');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i', 'before:end_time'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time']
        ]);

        $specialEvent = SpecialEvent::find($id);

        $specialEvent->name = $request->get('name');
        $specialEvent->date = $request->get('date');
        $specialEvent->start_time = $request->get('start_time');
        $specialEvent->end_time = $request->get('end_time');
        $specialEvent->room_id = $request->get('room_id');
        $specialEvent->description = $request->get('description');

        if($specialEvent->save()){
            return redirect()->route('admin_special_event_list', ['conference_id' => $conferenceId])->with('success', 'Special Event has been update successfully');
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
        $this->authorize('delete-special-event');
        $specialEvent = SpecialEvent::find($id);

        if ($specialEvent->delete()) {
            return redirect()->route('admin_special_event_list', ['conference_id' => $conferenceId])->with('success', 'Special Event has been deleted successfully');
        } else{
            return redirect()->route('admin_special_event_list', ['conference_id' => $conferenceId])->with('errors', 'Error');
        }
    }
}
