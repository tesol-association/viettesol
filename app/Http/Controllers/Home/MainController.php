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

class MainController extends HomeController
{
	public function index()
	{
		return view('layouts.home.layout');
	}
	public function getData()
	{
		$banners = Banner::all();
		return view('layouts.home.main',['banners'=> $banners ]);
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
			if($value->status == 'active'){
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
}
