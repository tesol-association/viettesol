<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use App\Models\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\View;

class BaseConferenceController extends Controller
{
    protected $conferenceId;
    protected $conference;
    // No Redis
    public function __construct(Request $request)
    {
        $this->conferenceId = $request->route('conference_id');
        $this->conference = Conference::find($this->conferenceId);
        View::share('conference', $this->conference);
    }

    // Redis
//    public function __construct(Request $request)
//    {
//        $this->conferenceId = $request->route('conference_id');
//        $this->conference = Redis::get('conference:'. $this->conferenceId);
//        if (!$this->conference) {
//            $this->conference = Conference::find($this->conferenceId);
//            Redis::set('conference:' . $this->conferenceId, serialize($this->conference));
//        } else {
//            $this->conference = unserialize(Redis::get('conference:' . $this->conferenceId));
//        }
//
//        View::share('conference', $this->conference);
//    }
}
