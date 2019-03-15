<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactType;
use App\Models\Contact;
use Session;

class ContactTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contactTypes = ContactType::all();
        $contacts = Contact::all();
        
        return view('layouts.admin.contact_type.list', ['contactTypes' => $contactTypes], ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('layouts.admin.contact_type.create');
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
        $request->validate([
            'name' => 'required|unique:contact_type',
        ]);

        $contactType = new ContactType([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);

        $contactType->save();
        
        return redirect()->route('admin_contact_type_list')->with('success', 'Successfully created type '. $contactType->name);
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
        $contactType = ContactType::find($id);

        return view('layouts.admin.contact_type.edit', compact('contactType'));
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
        // $request->validate([
        //     'name' => 'required|unique:contact_type,name,' . $id
        // ]);

        $contactType = ContactType::find($id);

        $contactType->name = $request->get('name');
        $contactType->description = $request->get('description');

        $contactType->save();

        return redirect()->route('admin_contact_type_list')->with('success', 'The change you have made has been saved.');
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
        $contactType = ContactType::find($id);
        $contactType->delete();

        return redirect()->route('admin_contact_type_list')->with('success', $contactType->name.' has been removed.');
    }
}
