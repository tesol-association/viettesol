<?php

namespace App\Http\Controllers\Admin\ConferenceManager\TrackDirector;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\ConferenceRepositories\PaperRepository;
use App\ConferenceRepositories\TrackRepository;
use App\ConferenceRepositories\ReviewAssignmentRepository;
use App\Events\PaperEvent\TrackDecided;
use App\Models\ConferenceRole;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

class PaperController extends BaseConferenceController
{
    protected $papers;
    protected $tracks;
    public function __construct(Request $request, PaperRepository $paperRepository, TrackRepository $trackRepository)
    {
        parent::__construct($request);
        $this->papers = $paperRepository;
        $this->tracks = $trackRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conferenceId)
    {
        $this->authorize('view-paper');
        $trackIds = Auth::user()->tracks->pluck('id')->all();
        $papers = $this->papers->get($conferenceId, ['track_id' => $trackIds]);
        return view('track_director.paper.list', [
            'conference_id' => $this->conferenceId,
            'papers'=> $papers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
