<?php

namespace App\Http\Controllers\Admin;

use App\Models\EventCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventCategoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $eventsCategory = EventCategory::all();
        return view('layouts.admin.event_category.list', ['eventsCategory' => $eventsCategory]);
    }

    public function create()
    {
        return view('layouts.admin.event_category.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data["slug"] = Str::slug($request->name, '-');
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->route('admin_events_category_create')
                ->withErrors($validator)
                ->withInput();
        }
        $eventCategory = new EventCategory();
        $eventCategory->name = $request->name;
        $eventCategory->slug = $data["slug"];
        $eventCategory->description = $request->description;
        $eventCategory->save();
        return redirect()->route('admin_events_category_list')->with('success', 'Create ' . $eventCategory->name . ' successful !');
    }

    public function edit($id)
    {
        $eventCategory = EventCategory::find($id);
        return view('layouts.admin.event_category.edit',['eventCategory'=> $eventCategory]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data["id"] = $id;
        $data["slug"] = Str::slug($request->title, '-');
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->route('admin_events_category_edit', ["id" => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $eventCategory = EventCategory::find($id);
        $eventCategory->name = $request->name;
        $eventCategory->slug = $data["slug"];
        $eventCategory->description = $request->description;
        $eventCategory->save();
        return redirect()->route('admin_events_category_list')->with('success', 'Update ' . $eventCategory->name . ' successful !');
    }

    public function destroy($id)
    {
        $eventCategory = EventCategory::find($id);
        if (count($eventCategory->categoryLinks)) {
            $eventTitle = $eventCategory->categoryLinks->first()->event->title;
            return redirect()->route('admin_events_category_list')->with('error','Please delete Event: ' . $eventTitle .  ' first or remove category: '. $eventCategory->name . '  from event '. $eventTitle . ' !');
        }
        EventCategory::destroy($id);
        return redirect()->route('admin_events_category_list')->with('success','Delete ' . $eventCategory->name . ' successful !');
    }

    public function validateData($data) {
        $id = isset($data["id"]) && $data["id"] ? $data["id"] : null;
        return Validator::make($data, [
            'name' => 'required',
            'slug' => 'required|unique:event_categories,slug,' . $id,
        ]);
    }
}
