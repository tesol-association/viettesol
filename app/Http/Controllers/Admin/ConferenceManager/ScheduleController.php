<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Buildings;

class ScheduleController extends BaseConferenceController
{
    public function index()
    {
    	$buildings = Buildings::where('conference_id', $this->conferenceId)->get();
    	
    	return view('layouts.admin.conference_manager.schedule.list',['buildings'=>$buildings]);
    }
}
