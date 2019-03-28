<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\TimeBlock;
use Session;

class TimeBlockController extends BaseConferenceController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timBlocks = TimeBlock::where('conference_id', $this->conferenceId)->get();
        return view('layouts.admin.conference_manager.time_block.list',['timeBlocks' => $timBlocks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conferenceId = $this->conferenceId;
        return view('layouts.admin.conference_manager.time_block.create',['conferenceId'=>$conferenceId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $this->validate($request,[
         'date'          => 'required',
         'start_time'    => 'required',
         'end_time'      => 'required'
     ]);

     TimeBlock::create([
        'date'           => $request->date,
        'start_time'     => $request->start_time,
        'end_time'       => $request->end_time,
        'conference_id'  => $request->conferenceId
    ]);
     Session::flash('success','Create successfully');
     return redirect()->route('admin_time_block_list',['conference_id'=>$this->conferenceId]);
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
        $timeBlock = TimeBlock::find($id);
        return view('layouts.admin.conference_manager.time_block.edit', ['timeBlock' => $timeBlock]);
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
        $request->validate([
            'date'       => 'required',
            'start_time' => 'required',
            'end_time'   => 'required'
        ]);
        $timeBlock = TimeBlock::find($id);
        $timeBlock->date      = $request->date;
        $timeBlock->start_time= $request->start_time;
        $timeBlock->end_time  = $request->end_time;

        $timeBlock->save();
        Session::flash('success','Update successfully');
        return redirect()->route('admin_time_block_list',['conference_id'=>$this->conferenceId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($conferenceId, $id)
    {
        TimeBlock::destroy($id);
        Session::flash('success','Delete successfully');
        return redirect()->route('admin_time_block_list',['conference_id'=>$this->conferenceId]);
    }
}
