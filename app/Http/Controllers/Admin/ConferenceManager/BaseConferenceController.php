<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use App\Models\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BaseConferenceController extends Controller
{
    protected $conferenceId;
    protected $conference;
    public function __construct(Request $request)
    {
        $this->conferenceId = $request->route('conference_id');
        $this->conference = Conference::find($this->conferenceId);
        $user = Auth::user();
//        $user->load('conferenceRoles');
        View::share('conference', $this->conference);
    }
}
