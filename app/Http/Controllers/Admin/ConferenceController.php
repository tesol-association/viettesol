<?php

namespace App\Http\Controllers\Admin;

use App\Models\Conference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ConferenceController extends Controller
{
    const UPLOAD_FOLDER = 'conference_overview';
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $conferences = Conference::all();
        return view('layouts.admin.conference.list', ['conferences'=> $conferences]);
    }

    public function view($id)
    {
        $conference = Conference::find($id);
        return view('layouts.admin.conference_layout', ['conference'=> $conference]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('layouts.admin.conference.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->route('admin_conference_create')
                ->withErrors($validator)
                ->withInput();
        }
        $conference = new Conference();
        $conference->slogan = $request->slogan;
        $conference->title = $request->title;
        $conference->path = $request->path;
        $conference->start_time = new \DateTime($request->start_time);
        $conference->end_time = new \DateTime($request->end_time);
        $conference->venue = $request->venue;
        $conference->description = $request->description;
        if ($request->hasFile('attach_file')) {
            $url = Storage::disk('public')->put(self::UPLOAD_FOLDER, $request->attach_file);
            $conference->attach_file = $url;
        }
        $conference->save();
        return redirect()->route('admin_conference_list')->with('success', 'Create ' . $conference->title . ' successful !');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $conference = Conference::find($id);
        return view('layouts.admin.conference.edit', ['conference' => $conference]);
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data["id"] = $id;
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->route('admin_conference_edit', ["id" => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $conference = Conference::find($id);
        if ($request->hasFile('attach_file')) {
            $path = Storage::disk('public')->put(self::UPLOAD_FOLDER, $request->attach_file);
            Storage::disk('public')->delete($conference->attach_file);
            $conference->attach_file = $path;
        }
        $conference->slogan = $request->slogan;
        $conference->title = $request->title;
        $conference->path = $request->path;
        $conference->start_time = new \DateTime($request->start_time);
        $conference->end_time = new \DateTime($request->end_time);
        $conference->venue = $request->venue;
        $conference->description = $request->description;
        $conference->save();
        return redirect()->route('admin_conference_list')->with('success', 'Update ' . $conference->title . ' successful !');
    }

    public function destroy($id)
    {
        $conference = Conference::find($id);
//        Conference::destroy($id);
//        return redirect()->route('admin_conference_list')->with('success','Delete ' . $conference->title . ' successfully !');
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($data)
    {
        $data["start_time"] = date('Y-m-d', strtotime($data["start_time"]));
        $data["end_time"] = date('Y-m-d', strtotime($data["end_time"]));
        $id = isset($data["id"]) && $data["id"] ? $data["id"] : null;
        return Validator::make($data, [
            'slogan' => 'required',
            'title' => 'required',
            'path' => 'required|unique:conferences,path,' . $id,
            'venue' => 'required',
            'start_time' => 'required|date|before:end_time',
            'end_time' => 'required|date|after:start_time',
        ]);
    }

}
