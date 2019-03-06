<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Partner;
use App\Models\Advertisement;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        $isAdmin = Auth::user()->is_admin;
        if ($isAdmin == 1) {
            return '/admin/index';
        } else {
            return '/';
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function showLoginForm()
    {
        $menus=DB::table('menu')->where('parent_id', '=', null)->get();
        $_menus=DB::table('menu')->where('parent_id', '!=', null)->get();
        $partners =  Partner::all();
        $advs = Advertisement::all();

        return view('auth.login',['menus'=> $menus,'_menus'=>$_menus, 'partners'=>$partners,'advs'=> $advs ]);
    }

}
