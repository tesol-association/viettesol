<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 4/2/2019
 * Time: 2:57 PM
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Home\HomeController;
use App\Mail\SendMagicLink;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class MagicController extends HomeController
{
    public function show()
    {
        return view('auth.magic_link');
    }

    public function sendToken(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255|exists:users,email'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('show_login_magic_link')->with('error', 'User not found. Please register');
        }

        $userToken = new UserToken();
        $userToken->user_id = $user->id;
        $userToken->token = str_random(50);
        $userToken->save();
        $url = url('/magic_link' . '?' . http_build_query([
                'remember' => $request->remember,
                'token' => $userToken->token,
                'email' => $request->email,
            ]));
        Mail::to($user->email)->send(new SendMagicLink($url));
        return back()->with('success', 'We\'ve sent you a magic link! The link expires in ' . Config::get('constants.TIME_TOKEN_EXPIRED') . ' minutes');
    }

    public function authenticate(Request $request)
    {
        $userToken = UserToken::where('token', $request->token)->first();
        if (!$userToken) {
            return redirect()->route('show_login_magic_link')->with('error', 'Invalid magic link.');
        }
        if ($userToken->isExpired()) {
            $userToken->delete();
        }
        Auth::login($userToken->user, $request->remember);
        $userToken->delete();
        return redirect()->route('home_page');
    }
}
