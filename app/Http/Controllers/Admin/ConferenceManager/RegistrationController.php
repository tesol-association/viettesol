<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\ConferenceRole;
use App\Models\Conference;
use Session;
use Illuminate\Support\Facades\Storage;


class RegistrationController extends BaseConferenceController
{
	const UPLOAD_FOLDER='upload/payment_file';

	public function create()
	{
        $this->authorize('create-register-conference');
		$roles = ConferenceRole::where('conference_id',$this->conferenceId)->get();
		return view('layouts.admin.conference_manager.registration.create', ['roles'=> $roles]);
	}
	public function store(Request $request)
	{
        $this->authorize('create-register-conference');
		$this->validate($request,[
			'name'           => 'required',
			'organization'   => 'required',
			'email'          => 'required',
			'phone'          => 'required',
			'payment_file'   => 'required',
			'affiliation'    => 'required',
			'role_id'        => 'required'
		]);

		if ($request->hasFile('payment_file')) {
            $path = Storage::disk('public')->put(self::UPLOAD_FOLDER, $request->payment_file);
        }

		Registration::create([
			'full_name'       => $request->name,
			'organization'    => $request->organization,
			'email'           => $request->email,
			'phone'           => $request->phone,
			'payment_file_id' => $path ?? null,
			'affiliation'     => $request->affiliation,
			'status'          => $request->status,
			'user_id'         => $request->user_id,
			'role_id'         => $request->role_id,
			'conference_id'   => $request->conference_id
		]);
		$conference = Conference::where('id',$this->conferenceId)->first();
		Session::flash('success','Registration successfully !');
		return redirect()->route('conference_home',['conference_path'=>$conference->path]);
	}
	public function getList()
	{
        $this->authorize('view-register-conference');
		$registers= Registration::where('conference_id',$this->conferenceId)->get();
		$status= array('pending','approved');
		return view('layouts.admin.conference_manager.registration.list',['registers'=>$registers,'status'=>$status]);
	}
	public function update(Request $request)
	{
        $this->authorize('update-register-conference');
		$id= $request->id;
		$status= $request->status;
		$register= Registration::find($id);
		$register->status = $status;
		if($register->save()){
			$data=array(
				'status' => true
			);
			echo json_encode($data);
		}else{
			$data=array(
				'status' => false
			);
			echo json_encode($data);
		}
	}
}
