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
		$papers = $this->papers->get($this->conferenceId);
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
		$buildings = Buildings::where('conference_id', $this->conferenceId)->get();
		return view('layouts.admin.conference_manager.schedule.list',['buildings'=>$buildings,'papers'=>$papers,'timeBlocks'=>$_timeBlocks]);
	}
	public function convertMin($time)
	{
		$timesplit=explode(':',$time);
		$min=($timesplit[0]*60)+($timesplit[1])+($timesplit[2]>30?1:0);
	    return $min;
	}

}
