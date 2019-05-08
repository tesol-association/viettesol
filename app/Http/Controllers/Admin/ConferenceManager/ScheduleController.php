<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Buildings;
use App\Models\Paper;
use App\Models\Track;
use App\ConferenceRepositories\PaperRepository;
use App\Models\TimeBlock;
use App\Models\Schedule;
use App\Models\SessionType;
use App\Models\PaperAuthor;
use Session;

class ScheduleController extends BaseConferenceController
{
	protected $papers;
	public function __construct(Request $request, PaperRepository $paperRepository)
	{
		parent::__construct($request);
		$this->papers = $paperRepository;
	}
	public function index()
	{
		$buildings = Buildings::where('conference_id', $this->conferenceId)->get();
		return view('layouts.admin.conference_manager.schedule.list',['buildings'=>$buildings]);
	}
	public function convertMin($time)
	{
		$timesplit=explode(':',$time);
		$min=($timesplit[0]*60)+($timesplit[1])+($timesplit[2]>30?1:0);
		return $min;
	}
	public function getTable(Request $request)
	{
		$buildings = Buildings::where('conference_id', $this->conferenceId)->get();
		$buildingsAndRoom=array();
		foreach ($buildings as $building) {
			foreach($building->rooms as $room){
				$buildingsAndRoom[]=array(
					'name_building' => $building->name,
					'id'            => $room->id,
					'name'          => $room->name
				);
			}
		}
		
		$timeBlocks=TimeBlock::where('conference_id', $this->conferenceId)->get()->toArray();

		$_timeBlocks=array();
		foreach ($timeBlocks as $key => $timeBlock) {
			$_timeBlocks[$key]=array(
				"id" => $timeBlock['id'],
				"date" => $timeBlock['date'],
				"start_time" => $timeBlock['start_time'],
				"end_time" => $timeBlock['end_time'],
				"conference_id" => $timeBlock['conference_id'],
				"color" => $timeBlock['color'],
				"created_at" => $timeBlock['created_at'],
				"updated_at" => $timeBlock['updated_at'],
				"duration"   => self::convertMin($timeBlock['end_time'])-self::convertMin($timeBlock['start_time'])
			);
		}
		$sessionTypes= SessionType::where('conference_id', $this->conferenceId)->get()->toArray();

		$papers = $this->papers->get($this->conferenceId, ['status' => Paper::STATUS_UNSCHEDULED]);

		$_papers=array();
		foreach ($papers as $key => $paper) {
			$_papers[$key]=$paper->toArray();
		}

		$paperAndSessionType = array();
		foreach ($_papers as $keyPaper => $_paper) {
			foreach ($sessionTypes as $sessionType) {
				if($_paper['session_type_id'] == $sessionType['id']){
					$paperAndSessionType[$keyPaper] = array(
						'id'        => $_paper['id'],
						'title'     => $_paper['title'],
						'duration'  => $sessionType['length']
					);
				}
			}
		}
		if(!empty($paperAndSessionType)){
			$data=array(
				'status'        => true,
				'paper'         => $paperAndSessionType,
				'timeblock'     => $_timeBlocks,
				'room'          => $buildingsAndRoom,
				'conference_id' => $this->conferenceId
			); 
			echo json_encode($data);
		}else{
			$data=array(
				'status' => false
			); 
			echo json_encode($data);
		}
		
	}
	public function addSchedule(Request $request)
	{
		$paperId = $request->paperId;
		$timeBlockId = $request->timeBlockId;
		$roomId  = $request->roomId;

		$authorId= PaperAuthor::where(['paper_id' => $paperId, 'seq'=>0 ])->first()->author_id;

		$authors= array();
		$papers = Schedule::where('time_block_id' , '=' , $timeBlockId)->get();

		$i= 0 ;
		if(!empty($papers)){
			foreach ($papers as $paper) {
				$author_id=  PaperAuthor::where(['paper_id' => $paper->paper_id, 'seq'=>0 ])->first()->author_id;	
				if($authorId == $author_id){
					$i++;
				}
			}
		}

		$count = Schedule::where([
			'time_block_id' => $timeBlockId,
			'room_id' => $roomId,
			'conference_id' => $request->conferenceId
		])->count();

		if($roomId == 'Select room'){
			$data=array(
				'status' => false,
				'notify' => 'Please choose room'
			); 
			echo json_encode($data);
		}else{
			if($count > 0) {
				$data=array(
					'status' => false,
					'notify' => 'This paper cannot be placed in the room you choose because there were other paper presented there.Please choose again !'
				); 
				echo json_encode($data);
			}elseif ($i >0) {
				$data=array(
					'status' => false,
					'notify' => 'The author of this article cannot present in the time block you choose.Please choose again !'
				); 
				echo json_encode($data);
			}
			else{
				$schedule= Schedule::create([
					'paper_id'      => $paperId,
					'time_block_id' => $timeBlockId,
					'room_id'       => $roomId,
					'conference_id' => $request->conferenceId
				]);

				if ($schedule) {
					$paper= Paper::find($paperId);
					$paper->status = 'scheduled';
					if($paper->save()){
						$data=array(
							'status' => true
						); 
						echo json_encode($data);
					}else{
						$data=array(
							'status' => false
						); 
						echo json_encode($data);
					}
				}else{
					$data=array(
						'status' => false
					); 
					echo json_encode($data);
				}
			} 
		} 
		
	}
	public function delete()
	{
		foreach ($this->conference->tracks as $track) {
			Paper::where('track_id', '=', $track->id)
			->update(['status' => 'unscheduled']);
		}
		Schedule::where('conference_id',$this->conferenceId)->delete();

		return redirect()->route('admin_schedule_list',['conference_id'=>$this->conferenceId]);
	}
	public function suggestSchedule()
	{
		$buildings = Buildings::where('conference_id', $this->conferenceId)->get();
		$timeBlocks=TimeBlock::where('conference_id', $this->conferenceId)->get()->toArray();
		$papers = $this->papers->get($this->conferenceId, ['status' => Paper::STATUS_UNSCHEDULED]);

		$rooms=array();
		foreach ($buildings as $building) {
			foreach ($building->rooms as $room) {
				$rooms[]= array(
					'room_id'   => $room->id,
					'room_name' => $room->name
				);
			}
		}

		$_timeBlock=array();
		foreach ($timeBlocks as $timeBlock) {
			$_timeBlock[]=array(
				"id"   => $timeBlock['id'],
				"date" => $timeBlock['date'],
				"start_time" => $timeBlock['start_time'],
				"end_time" => $timeBlock['end_time'],
				"duration"   => self::convertMin($timeBlock['end_time'])-self::convertMin($timeBlock['start_time'])
			);
		}

		$roomAndTimeBlocks =array();
		foreach ($rooms as $room) {
			foreach ($timeBlocks as $timeBlock) {
				$roomAndTimeBlocks[]= array(
					'room_id'    => $room['room_id'],
					'room_name'  => $room['room_name'],
					'timeblock_id'=> $timeBlock['id'],
					"date"       => $timeBlock['date'],
					"start_time" => $timeBlock['start_time'],
					"end_time"   => $timeBlock['end_time'],
					"duration"   => self::convertMin($timeBlock['end_time'])-self::convertMin($timeBlock['start_time'])
				);
			}
		}

		$sessionTypes= SessionType::where('conference_id', $this->conferenceId)->get()->toArray();

		$papers = $this->papers->get($this->conferenceId, ['status' => Paper::STATUS_UNSCHEDULED]);

		$_papers=array();
		foreach ($papers as $key => $paper) {
			$_papers[$key]=$paper->toArray();
		}

		$paperAndSessionTypes = array();
		foreach ($_papers as $keyPaper => $_paper) {
			foreach ($sessionTypes as $sessionType) {
				if($_paper['session_type_id'] == $sessionType['id']){
					$paperAndSessionTypes[$keyPaper] = array(
						'id'        => $_paper['id'],
						'title'     => $_paper['title'],
						'duration'  => $sessionType['length']
					);
				}
			}
		}

		$result=array();
		foreach ($paperAndSessionTypes as $paperAndSessionType) {
			foreach ($roomAndTimeBlocks as $key => $roomAndTimeBlock) {
				if($paperAndSessionType['duration'] <= $roomAndTimeBlock['duration'] ){
					$result[]= array(
						'id'       => $paperAndSessionType['id'],
						'title'    => $paperAndSessionType['title'],
						'duration' => $paperAndSessionType['duration'],
						'room_id'  => $roomAndTimeBlock['room_id'],
						'room_name'=> $roomAndTimeBlock['room_name'],
						'timeblock_id'=> $roomAndTimeBlock['timeblock_id'],
						'duration_timeblock'=>$roomAndTimeBlock['duration']
					);
					unset($roomAndTimeBlocks[$key]);
					break;
				}
			}
		}
		return view('layouts.admin.conference_manager.schedule.suggest',['buildings'=>$buildings,'timeBlocks'=>$timeBlocks,'papers'=>$result]);
	}
	public function storeScheduleSuggest(Request $request)
	{
		$paperIds= $request->paper_id;
		$roomIds= $request->room_id;
		$timeBlockIds= $request->timeblock_id;

		foreach ($paperIds as $key => $paperId) {
			$authorId= PaperAuthor::where(['paper_id' => $paperId, 'seq'=>0 ])->first()->author_id;

			$authors= array();
			$papers = Schedule::where('time_block_id' , '=' , $timeBlockIds[$key])->get();

			$i= 0 ;
			if(!empty($papers)){
				foreach ($papers as $paper) {
					$author_id=  PaperAuthor::where(['paper_id' => $paper->paper_id, 'seq'=>0 ])->first()->author_id;	
					if($authorId == $author_id){
						$i++;
					}
				}
			}

			if($i>0){
				Session::flash('error','The author of this article cannot present in the time block you choose.Please choose again paper');
				return redirect()->back();
			}else{
				$schedule= Schedule::create([
					'paper_id'      => $paperId,
					'time_block_id' => $timeBlockIds[$key],
					'room_id'       => $roomIds[$key],
					'conference_id' => $this->conferenceId
				]);
				if ($schedule) {
					$paper= Paper::find($paperId);
					$paper->status = 'scheduled';
					$paper->save();
				}

			}
		}
		Session::flash('success','Schedule has been created successfully');
		return redirect()->back();

	}

}
