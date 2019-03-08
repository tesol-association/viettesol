<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactType;
use Session;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
        
        return view('layouts.admin.contact.list', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $contactTypes = ContactType::all();

        return view('layouts.admin.contact.create', ['contactTypes' => $contactTypes]);
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
            'email' => 'required|email|unique:contacts',
            'phone' => 'required|numeric',
        ]);

        $contact = new Contact();
        $contact->type_id = $request->get('type_id');
        $contact->first_name = $request->get('first_name');
        $contact->middle_name = $request->get('middle_name');
        $contact->last_name = $request->get('middle_name');
        $contact->organize_name = $request->get('organize_name');
        $contact->address = $request->get('address');
        $contact->email = $request->get('email');
        $contact->phone = $request->get('phone');
        $contact->fax = $request->get('fax');
        $contact->country = $request->get('country');
        $contact->website = $request->get('website');
        $contact->note = $request->get('note');
        $contact->save();

        return redirect()->route('admin_contact_list')->with('success', 'A new contact has been added.');
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
        $contact = Contact::find($id);
        $contactTypes = ContactType::all();

        return view('layouts.admin.contact.edit', ['contact' => $contact], ['contactTypes' => $contactTypes]);
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
            'email' => 'required|email|unique:contacts,email,' .$id,
            'phone' => 'required|numeric',
        ]);
        
        $contact = Contact::find($id);


        $contact->type_id = $request->get('type_id');
        $contact->first_name = $request->get('first_name');
        $contact->middle_name = $request->get('middle_name');
        $contact->last_name = $request->get('last_name');
        $contact->organize_name = $request->get('organize_name');
        $contact->address = $request->get('address');
        $contact->email = $request->get('email');
        $contact->phone = $request->get('phone');
        $contact->fax = $request->get('fax');
        $contact->country = $request->get('country');
        $contact->website = $request->get('website');
        $contact->note = $request->get('note');

        $contact->save();

        return redirect()->route('admin_contact_list')->with('success', 'Contact '.$contact->id.' has been updated.');

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
        $contact = Contact::find($id);
        $contact->delete();

        return redirect()->route('admin_contact_list')->with('success', 'Contact '.$contact->id.' has been removed.');
    }

    public function make($id)
    {
        $contact = Contact::find($id);

        return view('layouts.admin.membership.make', ['contact' => $contact]);
    }
}
