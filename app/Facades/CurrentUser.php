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
    // No Redis
    public static function user()
    {
            $currentUser = Auth::user();
            if ($currentUser->conferenceRoles) {
                $currentUser->load('conferenceRoles');
            }
        return $currentUser;
    }
// Redis
//    public static function user()
//    {
//        $userId = Auth::id();
//        $currentUser = Redis::get('user:'. $userId);
//        if (!$currentUser) {
//            $currentUser = Auth::user();
//            if ($currentUser->conferenceRoles) {
//                $currentUser->load('conferenceRoles');
//            }
//            Redis::set('user:' . $userId, serialize($currentUser));
//        } else {
//            $currentUser = unserialize($currentUser);
//        }
//        return $currentUser;
//    }
}
