<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Buildings;
use App\Models\Paper;
use App\Models\Track;

class ScheduleController extends BaseConferenceController
{
    public function index()
    {
    	$tracks= Track::where('conference_id', $this->conferenceId)->get();
    	dd($tracks);
    	$buildings = Buildings::where('conference_id', $this->conferenceId)->get();
    	return view('layouts.admin.conference_manager.schedule.list',['buildings'=>$buildings]);
    }
    public function getPaper()
    {
    	$tracks= Track::where('conference_id', $this->conferenceId)->get();
    	dd($tracks);
    }
}
