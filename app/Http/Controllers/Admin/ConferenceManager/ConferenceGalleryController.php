<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\ConferenceGallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ConferenceGalleryController extends BaseConferenceController
{
    const GALLERY_FOLDER = 'conference_gallery';

    public function index($conferenceId)
    {
        $this->authorize('view-conference-gallery');
        $conferenceGallerys = ConferenceGallery::where('conference_id', $conferenceId)->get();
        return view('layouts.admin.conference_manager.conference_gallery.list', ['conferenceGallerys' => $conferenceGallerys, 'conference_id' => $conferenceId]);
    }

    public function store(Request $request, $conferenceId)
    {
        $this->authorize('create-conference-gallery');
        $this->validate($request, [
            "image" => 'required|array',
            "image.*" => 'required|image'
        ]);

        $images = $request->image;
        foreach ($images as $image) {
            $conferenceGallery = new ConferenceGallery();
            $path = Storage::disk('public')->put(self::GALLERY_FOLDER, $image);
            Storage::disk('public')->delete($conferenceGallery->image_url);
            $conferenceGallery->image_url = $path;
            $conferenceGallery->conference_id = $conferenceId;
            $conferenceGallery->created_by = Auth::user()->id;
            $conferenceGallery->save();
        }

        return redirect()->back()->with('success', 'Conference Gallery has been added successfully');
    }

    public function destroy($conferenceId, $id)
    {
        $this->authorize('delete-conference-gallery');
        $conferenceGallery = ConferenceGallery::find($id);
        Storage::disk('public')->delete($conferenceGallery->image_url);
        $conferenceGallery->delete();
        return redirect()->back()->with('success', 'Conference Gallery has been deleted successfully');
    }
}
