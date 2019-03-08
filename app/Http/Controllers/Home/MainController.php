<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Banner;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsCategoryLink;

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
        $news = News::all();

		return view('layouts.home.news',['news' => $news]);
	}
	public function getNewsDetail($slug)
	{
		dd($slug);
	}

}
