<?php

namespace App\Http\Controllers\Conference;

use App\Models\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Conference\BaseConferenceController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class BaseConferenceController extends Controller
{
    protected $conferencePath;
    protected $conference;
    public function __construct(Request $request)
    {
        $this->conferencePath = $request->route('conference_path');
        $this->conference = Conference::where('path',$this->conferencePath)->first();
        View::share('conference', $this->conference);
    }
}
