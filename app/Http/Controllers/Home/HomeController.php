<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Partner;

class HomeController extends Controller
{
	public function index()
	{
		$menus=DB::table('menu')->where('parent_id', '=', null)->get();
		$_menus=DB::table('menu')->where('parent_id', '!=', null)->get();
		$partners =  Partner::all();
		return view('layouts.home.layout',['menus'=> $menus,'_menus'=>$_menus, 'partners'=>$partners ]);
	}

}
