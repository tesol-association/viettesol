<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
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
        //
        $contact = Contact::all();
        
        return view('layouts.admin.contact.list', ['contacts' => $contact]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('layouts.admin.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $contact = new Contact([
            'type' => $request->get('type'),
            'first_name' => $request->get('first_name'),
            'middle_name' => $request->get('middle_name'),
            'last_name' => $request->get('middle_name'),
            'organize_name' => $request->get('organize_name'),
            'address' => $request->get('address'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'fax' => $request->get('fax'),
            'country' => $request->get('country'),
            'website' => $request->get('website'),
            'note' => $request->get('note')
        ]);

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
        $contact = Contact::find($id);

        return view('layouts.admin.contact.show', compact('contact'));
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

        return view('layouts.admin.contact.edit', compact('contact'));
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
        $contact = Contact::find($id);


        $contact->type = $request->get('type');
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
}
