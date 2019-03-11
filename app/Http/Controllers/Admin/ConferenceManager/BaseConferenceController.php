<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use App\Models\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class BaseConferenceController extends Controller
{
    protected $conferenceId;
    public function __construct(Request $request)
    {
        $this->conferenceId = $request->route('conference_id');
        $conference = Conference::find($this->conferenceId);
        View::share('conference', $conference);
    }
}
