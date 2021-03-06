<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Buildings;
use App\ConferenceRepositories\BuildingRepository;

class BuildingsController extends BaseConferenceController
{
    protected $buildingRepository;
    public function __construct(Request $request, BuildingRepository $buildings)
    {
        parent::__construct($request);
        $this->buildingRepository = $buildings;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view-building');
        $buildings = $this->buildingRepository->get(['conference_id'=>$this->conferenceId]);
        return view('layouts.admin.conference_manager.buildings.list', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-building');
        return view('layouts.admin.conference_manager.buildings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $conferenceId)
    {
        $this->authorize('create-building');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'abbrev' => ['required', 'string', 'max:45'],
            'conference_id' => ['required', 'numeric']
        ]);

        $building = $this->buildingRepository->create($request->all());

        return redirect()->route('admin_buildings_list', $conferenceId)->with('success', 'Building has been added successfully');
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
    public function edit($conferenceId, $id)
    {
        $this->authorize('update-building');
        $building = Buildings::find($id);
        return view('layouts.admin.conference_manager.buildings.edit', ['building' => $building]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $conferenceId, $id)
    {
        $this->authorize('update-building');
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'abbrev' => ['required', 'string', 'max:45'],
        ]);

        $building = $this->buildingRepository->update($id, $request->all());

        return redirect()->route('admin_buildings_list', $conferenceId)->with('success', 'Building has been update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $conferenceId, $id)
    {
        $this->authorize('delete-building');
        $building = $this->buildingRepository->destroy($id);

        return redirect()->route('admin_buildings_list', $conferenceId)->with('success', 'Building has been deleted successfully');
    }
}
