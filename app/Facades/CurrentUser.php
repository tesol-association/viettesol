<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/31/2019
 * Time: 10:31 AM
 */

namespace App\Facades;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class CurrentUser extends Auth
{
    public static function user()
    {
//        $currentUser = Redis::get('user');
//        if (!$currentUser) {
            $currentUser = Auth::user();
            if ($currentUser->conferenceRoles) {
                $currentUser->load('conferenceRoles');
            }
//            Redis::set('user', $currentUser);
//        }
        return $currentUser;
    }
}
