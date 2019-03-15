<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use Illuminate\Support\Facades\Storage;
use App\Models\Speakers;

class SpeakersController extends BaseConferenceController
{
    const AVATAR_FOLDER = 'speakers_avatar';
    const FILE_FOLDER = 'speakers_file';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conferenceId)
    {
        $speakers = Speakers::where('conference_id', $conferenceId)->get();
        return view('layouts.admin.conference_manager.speaker.list', compact('speakers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($conferenceId)
    {
        return view('layouts.admin.conference_manager.speaker.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $conferenceId)
    {
        $request->validate([
            'image' => ['required', 'image'],
            'full_name' => ['required', 'string', 'max:255'],
            'affiliate' => ['required', 'string', 'max:255'],
        ]);

        $speaker = new Speakers();

        $path = Storage::disk('public')->put(self::AVATAR_FOLDER, $request->image);
        Storage::disk('public')->delete($speaker->image);
        $speaker->image = $path;
        $speaker->full_name = $request->get('full_name');
        $speaker->affiliate = $request->get('affiliate');
        $speaker->biography = $request->get('biography');
        $speaker->site_url = $request->get('site_url');
        $speaker->abstract = $request->get('abstract');
        $speaker->conference_id = $conferenceId;
        if ($request->hasFile('attach_file')) {
            $path = Storage::disk('public')->put(self::FILE_FOLDER, $request->attach_file);
            $speaker->attach_file = $path;
        }

        if($speaker->save()){
            return redirect()->route('admin_speakers_list', ["conference_id" => $conferenceId])->with('success', 'Speaker has been add successfully');
        }else{
            return redirect()->back()->with('errors', 'Error');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($conferenceId, $id)
    {
        $speaker = Speakers::find($id);
         return view('layouts.admin.conference_manager.speaker.view', ["conference_id" => $conferenceId, "speaker" => $speaker ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($conferenceId, $id)
    {
        $speaker = Speakers::find($id);
        return view('layouts.admin.conference_manager.speaker.edit', ["conference_id" => $conferenceId, "speaker" => $speaker ]);
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
            'full_name' => ['required', 'string', 'max:255'],
            'affiliate' => ['required', 'string', 'max:255'],
        ]);

        $speaker = Speakers::find($id);

        if ($request->hasFile('image')){
            $path = Storage::disk('public')->put(self::AVATAR_FOLDER, $request->image);
            Storage::disk('public')->delete($speaker->image);
            $speaker->image = $path;
        }
        $speaker->full_name = $request->get('full_name');
        $speaker->affiliate = $request->get('affiliate');
        $speaker->biography = $request->get('biography');
        $speaker->site_url = $request->get('site_url');
        $speaker->abstract = $request->get('abstract');
        if ($request->hasFile('attach_file')) {
            $path = Storage::disk('public')->put(self::FILE_FOLDER, $request->attach_file);
            Storage::disk('public')->delete($speaker->attach_file);
            $speaker->attach_file = $path;
        }

        if($speaker->save()){
            return redirect()->route('admin_speakers_view',  ["conference_id" => $conferenceId, "speaker" => $speaker])->with('success', 'Speaker has been update successfully');
        }else{
            return redirect()->back()->with('errors', 'Error');
        } 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($conferenceId, $id)
    {
        $speaker = Speakers::find($id);

         if($speaker->delete()){
            Storage::disk('public')->delete($speaker->image);
            Storage::disk('public')->delete($speaker->attach_file);
            return redirect()->route('admin_speakers_list', ["conference_id" => $conferenceId])->with('success', 'Speaker has been deleted successfully');
        }else{
            return redirect()->route('admin_speakers_list', ["conference_id" => $conferenceId])->with('errors', 'Error');
        }
    }
}
