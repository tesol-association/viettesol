<?php

namespace App\Http\Controllers\Conference;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConferenceController extends BaseConferenceController
{
    public function index()
    {
    	$conference = $this->conference;
    	return view('layouts.conference.home',['conference_path'=>$this->conferencePath]);
    }
    public function getNews()
    {
    	
    	return view('layouts.conference.news',['conference_path'=>$this->conferencePath]); 
    }

}
