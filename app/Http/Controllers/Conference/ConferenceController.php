<?php

namespace App\Http\Controllers\Conference;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConferenceController extends BaseConferenceController
{
    public function index()
    {
    	dd($this->conferencePath);
    }
}
