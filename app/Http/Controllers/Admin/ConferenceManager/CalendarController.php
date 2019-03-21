<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Buildings;
use App\Models\Rooms;
use App\Models\Schedule;

class CalendarController extends BaseConferenceController
{
	public function index()
	{
		return view('layouts.admin.conference_manager.calendar.list',['conference_id'=>$this->conferenceId]);
	}
	public function getData()
	{
		$schedule= Schedule::where('conference_id', $this->conferenceId)->get()->toArray();
		//dd($schedule);

		$buildings = Buildings::where('conference_id', $this->conferenceId)->get()->toArray();
		$rooms= Rooms::all()->toArray();
		$roomConference=array();

		foreach ($buildings as $building) {
			foreach ($rooms as $room) {
				if($building['id'] == $room['building_id']){
                    $roomConference[] = array(
                       'id'       => $room['id'],
                       'building' => $building['name'],
                       'title'    => $room['name']
                    );
				}
			}
		}
		$data=array(
           'status' => true,
           'room'   => $roomConference
		);
		echo json_encode($data ,true);
	}
}
