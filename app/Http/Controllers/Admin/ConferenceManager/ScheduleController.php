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

		$count = Schedule::where([
			'time_block_id' => $timeBlockId,
			'room_id' => $roomId,
			'conference_id' => $request->conferenceId
		])->count();

		if($count > 0) {
			$data=array(
				'status' => false
			); 
			echo json_encode($data);
		}else{
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
	public function delete()
	{
		foreach ($this->conference->tracks as $track) {
			Paper::where('track_id', '=', $track->id)
			->update(['status' => 'unscheduled']);
		}
		Schedule::where('conference_id',$this->conferenceId)->delete();

		return redirect()->route('admin_schedule_list',['conference_id'=>$this->conferenceId]);
	}

}
