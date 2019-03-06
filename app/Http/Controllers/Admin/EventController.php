<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventCategoryLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    const UPLOAD_FOLER = 'event_cover';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $events = Event::all();
        foreach ($events as $event) {
            $event->tags = json_decode($event->tags, true);
        }
        return view('layouts.admin.event.list', ['events'=> $events]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $eventsCategory = EventCategory::all();
        return view('layouts.admin.event.create', ['eventsCategory' => $eventsCategory]);
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
                ->route('admin_event_create')
                ->withErrors($validator)
                ->withInput();
        }
        $path = '';
        if ($request->hasFile('cover')) {
            $path = Storage::disk('public')->put(self::UPLOAD_FOLER, $request->cover);
        }
        $event = new Event();
        $event->title = $request->title;
        $event->slug = $request->slug;
        $event->cover = $path;
        $event->start_time = new \DateTime($request->start_time);
        $event->end_time = new \DateTime($request->end_time);
        $event->venue = $request->venue;
        $event->trainer = $request->trainer;
        $event->fee = $request->fee;
        $event->short_content = $request->short_content;
        $event->body = $request->body;
        $event->description = $request->description;
        $event->tags = json_encode($request->tags);
        $event->status = $request->status;
        $event->last_updated_by = Auth::id();
        $event->created_by = Auth::id();
        $event->save();
        if ($request->event_category) {
            foreach ($request->event_category as $categoryId) {
                $eventCategoryLink = new EventCategoryLink();
                $eventCategoryLink->event_id = $event->id;
                $eventCategoryLink->category_id = $categoryId;
                $eventCategoryLink->save();
            }
        }
        return redirect()->route('admin_event_list')->with('success', 'Create ' . $event->title . ' successful !');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $event->tags = json_decode($event->tags, true);
        $categories = [];
        foreach ($event->categoryLinks as $categoryLink) {
            $categories[] = $categoryLink->category->id;
        }
        $event->categories = $categories;
        $eventCategory = EventCategory::all();
        return view('layouts.admin.event.edit', ['event' => $event, 'eventCategory' => $eventCategory]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Request $request,$id)
    {
        $data = $request->all();
        $data["id"] = $id;
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->route('admin_event_edit', ["id" => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $event = Event::find($id);
        if ($request->hasFile('cover')) {
            $path = Storage::disk('public')->put(self::UPLOAD_FOLER, $request->cover);
            Storage::disk('public')->delete($event->cover);
            $event->cover = $path;
        }
        $event->title = $request->title;
        $event->slug = $request->slug;
        $event->start_time = new \DateTime($request->start_time);
        $event->end_time = new \DateTime($request->end_time);
        $event->venue = $request->venue;
        $event->trainer = $request->trainer;
        $event->fee = $request->fee;
        $event->short_content = $request->short_content;
        $event->body = $request->body;
        $event->description = $request->description;
        $event->tags = json_encode($request->tags);
        $event->status = $request->status;
        $event->last_updated_by = Auth::id();
        $event->save();
        $categorieIds = [];
        foreach ($event->categoryLinks as $categoryLink) {
            $categorieIds[] = $categoryLink->category->id;
        }
        $sendedCategories = $request->event_category;
        foreach ($sendedCategories as $index => $categoryId) {
            if (($key = array_search($categoryId, $categorieIds)) === false) {
                $eventCategoryLink = new EventCategoryLink();
                $eventCategoryLink->event_id = $event->id;
                $eventCategoryLink->category_id = $categoryId;
                $eventCategoryLink->save();
            } else {
                unset($sendedCategories[$index]);
                unset($categorieIds[$key]);
            }
        }
        if (isset($categorieIds) && count($categorieIds)) {
            foreach ($categorieIds as $categoryId) {
                EventCategoryLink::where('event_id', $event->id)->where('category_id', $categoryId)->delete();
            }
        }
        return redirect()->route('admin_event_list')->with('success', 'Update ' . $event->title . ' successful !');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        foreach ($event->categoryLinks as $categoryLink) {
            EventCategoryLink::destroy($categoryLink->id);
        }
        Event::destroy($id);
        return redirect()->route('admin_event_list')->with('success','Xóa thành công: ' . $event->title . '!');
    }
    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($data)
    {
        $data["start_time"] = date('Y-m-d h:i', strtotime($data["start_time"]));
        $data["end_time"] = date('Y-m-d h:i', strtotime($data["end_time"]));
        $id = isset($data["id"]) && $data["id"] ? $data["id"] : null;
        return Validator::make($data, [
            'title' => 'required',
            'slug' => 'required|unique:events,slug,' . $id,
            'short_content' => 'required',
            'cover' => 'image',
            'body' => 'required',
            'venue' => 'required',
            'trainer' => 'required',
            'fee' => 'numeric',
            'start_time' => 'required|date|before:end_time',
            'end_time' => 'required|date|after:start_time',
            'status' => ['required', Rule::in(['draft', 'published'])],
            'event_category' => 'required',
        ]);
    }

}
