<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsCategoryLink;
use App\Models\Comment;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventCategoryLink;
use App\Models\EventRegistration;
use Session;

class MainController extends HomeController
{
	public function index()
	{
		return view('layouts.home.layout');
	}
	public function getData()
	{
		$banners = Banner::all();
		$news= News::orderBy('id', 'DESC')->limit(5)->offset(0)->get();
		$events=Event::orderBy('id', 'DESC')->limit(5)->offset(0)->get();
		return view('layouts.home.main',['banners'=> $banners,'news'=>$news,'events'=>$events ]);
	}
	public function getNews()
	{
		$news = News::orderBy('id', 'DESC')->get();
		return view('layouts.home.news',['news' => $news]);
	}
	public function getNewsDetail($slug)
	{
		$i=0;
		$newsDetail = News::where('slug', '=', $slug)->first();
		$idNews = $newsDetail->id;
		$tags = json_decode($newsDetail->tags, true);
		$comments = Comment::where('new_id', '=', $idNews)->get();
		foreach ($comments as $value) {
			if($value->status == 'approved'){
				$i++;
			}
		}
		return view('layouts.home.news_detail',['newsDetail'=> $newsDetail,'tags' => $tags, 'idNews' => $idNews, 'comments' => $comments, 'sizeComment'=> $i]);
	}
	public function getNewsByCategory($slug)
	{
		$category= NewsCategory::where('slug','=',$slug)->first();
		return view('layouts.home.news_category',['category'=>$category]);
	}
	public function getNewsByTag($tag)
	{
		$news= News::where('tags','like','%' .$tag. '%')->get();
		return view('layouts.home.news_tag',['news'=> $news]);
	}
	public function getEvent()
	{
		$events= Event::orderBy('id', 'DESC')->get();
		return view('layouts.home.event',['events' => $events]);
	}
	public function getEventDetail($slug)
	{
		$eventDetail = Event::where('slug', '=', $slug)->first();
		$tags = json_decode($eventDetail->tags, true);
		return view('layouts.home.event_detail',['eventDetail'=>$eventDetail,'tags'=>$tags]);
	}
	public function getEventByCategory($slug)
	{
		$category= EventCategory::where('slug','=',$slug)->first();
		return view('layouts.home.event_category',['category'=>$category]);
	}
	public function getEventByTag($tag)
	{
		$events= Event::where('tags','like','%' .$tag. '%')->get();
		return view('layouts.home.event_tag',['events'=> $events]);
	}
	public function createFormRegistraion($id)
	{
		$event=Event::where('id','=',$id)->first();
		return view('layouts.home.registration_form',['event'=>$event]);
	}
	public function addRegisterEvent(Request $request)
	{
		$this->validate($request,[
           'full_name'  => 'required',
           'gender'     => 'required',
           'affiliation'=> 'required',
           'email'      => 'required'
        ]);
        EventRegistration::create([
           'full_name'     => $request->full_name,
           'gender'        => $request->gender,
           'affiliation'   => $request->affiliation,
           'department'    => $request->department,
           'position'      => $request->position,
           'address'       => $request->address,
           'email'         => $request->email,
           'phone'         => $request->phone,
           'highest_degree'=> $request->highest_degree,
           'email_notify'  => $request->email_notify,
           'event_id'      => $request->event_id 
        ]);
        Session::flash('success','successful registration !');
        return redirect()->back();
	}
}
