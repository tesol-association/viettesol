<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Buildings;
use App\Models\Rooms;
use App\Models\Paper;
use App\Models\Schedule;
use App\Models\TimeBlock;
use App\ConferenceRepositories\PaperRepository;

class CalendarController extends BaseConferenceController
{
	protected $papers;
	public function __construct(Request $request, PaperRepository $paperRepository)
	{
		parent::__construct($request);
		$this->papers = $paperRepository;
	}
	public function index()
	{
		return view('layouts.admin.conference_manager.calendar.list',['conference_id'=>$this->conferenceId]);
	}
	public function getData()
	{
		$papers = $this->papers->get($this->conferenceId, ['status' => Paper::STATUS_SCHEDULED]);

		$_papers=array();
		foreach ($papers as $paper) {
			$_papers[]=$paper->toArray();
		}

        $events = array();
		$schedules = Schedule::where('conference_id', $this->conferenceId)->get()->toArray();
		$timeBlocks=TimeBlock::where('conference_id', $this->conferenceId)->get()->toArray();
		foreach ($schedules as $schedule) {
			foreach ($timeBlocks as $timeBlock) {
				if($timeBlock['id'] == $schedule['time_block_id']){
					$events[] = array(
                        'paper_id'   => $schedule['paper_id'], 
                        'room_id'    => $schedule['room_id'],
                        'start'      => $timeBlock['date'].'T'.$timeBlock['start_time'],
                        'end'        => $timeBlock['date'].'T'.$timeBlock['end_time']
					);
				}
			}
		}
        $i = 0;
		$eventPaper = array();
		foreach ($events as $event) {
			foreach ($_papers as $_paper) {
				if ($_paper['id'] == $event['paper_id']) {
					$eventPaper[] =array(
                        'id'        => $i,
                        'resourceId'=> $event['room_id'],
                        'start'     => $event['start'],
                        'end'       => $event['end'],
                        'title'     => $_paper['title']
					);
					$i++;
				}
			}
		}
		
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
           'room'   => $roomConference,
           'events'  => $eventPaper
		);
		echo json_encode($data ,true);
	}
	public function calendarConference()
	{
		return view('layouts.admin.conference_manager.calendar.conferenceCalendar',['conference_id'=>$this->conferenceId]);
	}
}
