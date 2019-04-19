<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\ConferenceRole;
use App\Models\Conference;
use Session;

class RegistrationController extends BaseConferenceController
{
	const UPLOAD_FOLDER='upload/payment_file';

	public function create()
	{
		$roles = ConferenceRole::where('conference_id',$this->conferenceId)->get();
		return view('layouts.admin.conference_manager.registration.create', ['roles'=> $roles]);
	}
	public function store(Request $request)
	{
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
			if ($request->file('payment_file')->isValid()) {
				try {
					$file = $request->file('payment_file');
					$nameImage = $file->getClientOriginalName();

					$path = $file->move(self::UPLOAD_FOLDER, $nameImage);
				} catch (Illuminate\Filesystem\FileNotFoundException $e) {

				}
			}
		}
		Registration::create([
			'full_name'       => $request->name,
			'organization'    => $request->organization,
			'email'           => $request->email,
			'phone'           => $request->phone,
			'payment_file_id' => asset($path),
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
		$registers= Registration::where('conference_id',$this->conferenceId)->get();
		$status= array('pending','approved');
		return view('layouts.admin.conference_manager.registration.list',['registers'=>$registers,'status'=>$status]);
	}
	public function update(Request $request)
	{
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
