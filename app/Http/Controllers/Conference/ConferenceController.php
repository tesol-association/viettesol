<?php

namespace App\Http\Controllers\Conference;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Conference;
use App\Models\Speakers;

class ConferenceController extends BaseConferenceController
{
    public function index()
    {
    	dd($this->conferencePath);
    }

    public function speaker()
    {
    	$speakers = $this->conference->speakers;

    	return view('layouts.conference.speakers', ["speakers" => $speakers]);
    }
}
