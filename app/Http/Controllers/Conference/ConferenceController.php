<?php

namespace App\Http\Controllers\Conference;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Announcements;
use App\Models\ConferenceTimeline;
use App\Models\ConferencePartnerSponser;
use App\Models\Fee;
use App\Models\Conference;
use App\Models\Speakers;

class ConferenceController extends BaseConferenceController
{
    public function index()
    {
    	$conference = $this->conference;
    	$conferenceTimeline= ConferenceTimeline::where('conference_id', $conference->id)->first();
    	$fees = Fee::where('conference_id', $conference->id)->get();
        $conferencePartnerSponsers= ConferencePartnerSponser::orderBy('id', 'DESC')->limit(8)->offset(0)->get();
    	return view('layouts.conference.home',['conference_path'=>$this->conferencePath, 'conferenceTimeline'=> $conferenceTimeline, 'conferencePartnerSponsers'=> $conferencePartnerSponsers, 'fees'=> $fees]);
    }
    public function getNews()
    {
    	$announcements = Announcements::orderBy('id', 'DESC')->paginate(4);
    	return view('layouts.conference.news',['conference_path'=>$this->conferencePath,'announcements'=> $announcements]); 
    }
    public function getNewsDetail($conferencePath, $id)
    {
       $announcement =	Announcements::where('id',$id)->first();
       return view('layouts.conference.news_detail',['conference_path'=>$this->conferencePath,'announcement'=> $announcement]);
    }

    public function speaker()
    {
    	$speakers = $this->conference->speakers;

    	return view('layouts.conference.speakers', ["speakers" => $speakers]);
    }
}
