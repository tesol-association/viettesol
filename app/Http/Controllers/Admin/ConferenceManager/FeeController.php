<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Fee;

class FeeController extends BaseConferenceController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fees = Fee::where('conference_id', $this->conferenceId)->get();
        return view('layouts.admin.conference_manager.fee.list', ['fees'=>$fees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin.conference_manager.fee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'time' => 'required|date',
            'category.*' =>'required',
            'price_before_time.*' => 'required',
            'price_after_time.*' => 'required',
        ]);

        foreach ($request->category as $key => $value) {
            $fee = new Fee();
            $fee->time = $request->time;
            $fee->category = $request->category[$key];
            $fee->price_before_time = $request->price_before_time[$key];
            $fee->price_after_time = $request->price_after_time[$key];
            $fee->description = $request->description[$key];
            $fee->conference_id = $this->conferenceId;
            $fee->save();
        }
        return redirect()->route('admin_fee_list', $this->conferenceId)->with('success', 'Fee has been added successfully');
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
        $fee = Fee::find($id);
        return view('layouts.admin.conference_manager.fee.edit', ['fee' => $fee]);
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
            'time' => 'required|date',
            'category' =>'required',
            'price_before_time' => 'required',
            'price_after_time' => 'required',
        ]);

        $fee = Fee::find($id);
        $fee->time = $request->time;
        $fee->category = $request->category;
        $fee->price_before_time = $request->price_before_time;
        $fee->price_after_time = $request->price_after_time;
        $fee->description = $request->description;
        $fee->conference_id = $this->conferenceId;
        $fee->save();
        return redirect()->route('admin_fee_list', $this->conferenceId)->with('success', 'Fee has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($conferenceId, $id)
    {
        $fee = Fee::find($id);
        $fee->delete();
        return redirect()->route('admin_fee_list', $this->conferenceId)->with('success', 'Fee has been deleted successfully');
    }
}
