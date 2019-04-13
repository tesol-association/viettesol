<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\MembershipType;
use App\Models\Contact;
use App\Models\MemberType;
use Session;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $members = Membership::all();

        return view("layouts.admin.membership.list", ['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $contacts = Contact::all();
<<<<<<< HEAD
        $msTypes = MembershipType::all();
        return view("layouts.admin.membership.create", ['contacts' => $contacts, 'msTypes' => $msTypes]);
=======
        $memberTypes = MemberType::all();
        return view("layouts.admin.membership.create", ['contacts' => $contacts], ['memberTypes' => $memberTypes]);
>>>>>>> ba88a9a26f479319b5c9c4645e7b5cbcfe0c688b
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
            'contact_id'=>'required|integer|unique:membership',
<<<<<<< HEAD
            'type_id'=>'required',
            'mscode'=>'unique:membership',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date',
=======
            'type_id' => 'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date'
>>>>>>> ba88a9a26f479319b5c9c4645e7b5cbcfe0c688b
        ]);

        $member = new Membership();
        $member->contact_id = $request->get('contact_id');
        $member->type_id = $request->get('type_id');
        $member->start_date = $request->get('start_date');
        $member->end_date = $request->get('end_date');
<<<<<<< HEAD
        $member->mscode = $this->codeGenerate();
=======
>>>>>>> ba88a9a26f479319b5c9c4645e7b5cbcfe0c688b

        $member->save();

        return redirect()->route('admin_membership_list')->with('success', 'A new Membership has been added.');
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
        $member = Membership::find($id);

        return view('layouts.admin.membership.show', ['member' => $member]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $member = Membership::find($id);
<<<<<<< HEAD
        $msTypes = MembershipType::all();

        return view('layouts.admin.membership.edit', ['member' => $member, 'msTypes' => $msTypes]);
=======
        $memberTypes = MemberType::all();
        return view('layouts.admin.membership.edit',['member' => $member], ['memberTypes' => $memberTypes]);
>>>>>>> ba88a9a26f479319b5c9c4645e7b5cbcfe0c688b
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'contact_id'=>'required|integer|unique:membership',
<<<<<<< HEAD
            'type_id'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date',
=======
            'type_id' => 'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date'
>>>>>>> ba88a9a26f479319b5c9c4645e7b5cbcfe0c688b
        ]);

        $member = Membership::find($id);

        $member->contact_id = $request->get('contact_id');
        $member->type_id = $request->get('type_id');
        $member->start_date = $request->get('start_date');
        $member->end_date = $request->get('end_date');

        $member->save();

        return redirect()->route('admin_membership_list')->with('success', 'Membership with Contact ID {{ $member->contact_id }} has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $member = Membership::find($id);
        $member->delete();

        return redirect()->route('admin_membership_list')->with('success', 'A membership has been removed.');
    }

    public function codeGenerate()
    {
        $char = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $code = "VTS";
        for ($i = 0; $i < 7; $i++)
        {
            $code .= $char[ rand(0, strlen($char) - 1) ];
        }

        return $code;
    }
}
