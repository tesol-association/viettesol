<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Contact;
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
        return view("layouts.admin.membership.create", ['contacts' => $contacts]);
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
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date',
            'num_of_term'=>'required'
        ]);

        $member = new Membership();
        $member->contact_id = $request->get('contact_id');
        $member->start_date = $request->get('start_date');
        $member->end_date = $request->get('end_date');
        $member->num_of_term = $request->get('num_of_term');

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

        return view('layouts.admin.membership.edit',['member' => $member]);
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
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date',
            'num_of_term'=>'required'
        ]);

        $member = Membership::find($id);

        $member->contact_id = $request->get('contact_id');
        $member->start_date = $request->get('start_date');
        $member->end_date = $request->get('end_date');
        $member->num_of_term = $request->get('num_of_term');

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
}