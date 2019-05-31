<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\ConferencePartnerSponser;

class ConferencePartnerSponserController extends BaseConferenceController
{
	const LOGO_FOLDER = 'conference_partners_sponsers_logo_folder';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conferenceId)
    {
        $this->authorize('view-conference-gallery');
        $conferencePartnersSponsers = ConferencePartnerSponser::where('conference_id', $conferenceId)->get();
        return view('layouts.admin.conference_manager.conference_partner_sponser.list', ['conference_id' => $conferenceId, 'conferencePartnersSponsers' => $conferencePartnersSponsers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($conferenceId)
    {
        $this->authorize('create-conference-gallery');
        return view('layouts.admin.conference_manager.conference_partner_sponser.create', ['conference_id' => $conferenceId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $conferenceId)
    {
        $this->authorize('create-conference-gallery');
        $request->validate([
        	'name' => ['required', 'string', 'max:255'],
            'logo' => ['required', 'image'],
            'type' => ['required', Rule::in(['partner', 'sponsor'])],
        ]);

        $conferencePartnersSponsers = new ConferencePartnerSponser();

        $conferencePartnersSponsers->name = $request->get('name');
        $path = Storage::disk('public')->put(self::LOGO_FOLDER, $request->logo);
        $conferencePartnersSponsers->logo = $path;
        $conferencePartnersSponsers->type = $request->get('type');
        $conferencePartnersSponsers->description = $request->get('description');
        $conferencePartnersSponsers->conference_id = $conferenceId;

        if($conferencePartnersSponsers->save()){
            return redirect()->route('admin_conference_partners_sponsers_list', ['conference_id' => $conferenceId]) ->with('success', 'Conference Partners Sponsers has been add successfully');
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
        $this->authorize('update-conference-gallery');
        $conferencePartnersSponser = ConferencePartnerSponser::find($id);
        return view('layouts.admin.conference_manager.conference_partner_sponser.edit', ['conference_id' => $conferenceId, 'conferencePartnersSponser' => $conferencePartnersSponser]);
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
        $this->authorize('update-conference-gallery');
        $request->validate([
        	'name' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(['partner', 'sponsor'])],
        ]);

       $conferencePartnersSponser = ConferencePartnerSponser::find($id);

        $conferencePartnersSponser->name = $request->get('name');
        if ($request->hasFile('logo')){
        	$path = Storage::disk('public')->put(self::LOGO_FOLDER, $request->logo);
	        Storage::disk('public')->delete($conferencePartnersSponser->logo);
	        $conferencePartnersSponser->logo = $path;
        }
        $conferencePartnersSponser->type = $request->get('type');
        $conferencePartnersSponser->description = $request->get('description');

        if($conferencePartnersSponser->save()){
            return redirect()->route('admin_conference_partners_sponsers_list', ['conference_id' => $conferenceId]) ->with('success', 'Conference Partners Sponsers has been updated successfully');
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
        $this->authorize('delete-conference-gallery');
       $conferencePartnersSponser = ConferencePartnerSponser::find($id);

       if($conferencePartnersSponser->delete()){
            return redirect()->route('admin_conference_partners_sponsers_list', ['conference_id' => $conferenceId]) ->with('success', 'Conference Partners Sponsers has been deleted successfully');
        }else{
            return redirect()->back()->with('errors', 'Error');
        }
    }
}
