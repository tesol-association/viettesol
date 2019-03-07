<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Partner;
use App\Models\Advertisement;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
	public function __construct()
	{
		$menus=DB::table('menu')->where('parent_id', '=', null)->get();
		$_menus=DB::table('menu')->where('parent_id', '!=', null)->get();
		$partners =  Partner::all();
		$advs = Advertisement::all();
		View::share(['menus'=> $menus,'_menus'=>$_menus, 'partners'=>$partners,'advs'=> $advs ]);
	}

}
