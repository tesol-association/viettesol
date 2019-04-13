<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MemberType;
use Session;

class MemberTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $memberTypes = MemberType::all();

        return view('layouts.admin.membertype.list', ['memberTypes' => $memberTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('layouts.admin.membertype.create');
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
            'name' => 'required|unique:membership_types',
        ]);

        $memberType = new MemberType([
            'name' => $request->get('name'),
            'description' => $request->get('description')
        ]);

        $memberType->save();
        
        return redirect()->route('admin_membertype_list')->with('success', 'Successfully created type '. $memberType->name);
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
        $memberType = MemberType::find($id);

        return view('layouts.admin.membertype.edit', ['memberType' => $memberType]);
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
        $memberType = MemberType::find($id);

        $memberType->name = $request->get('name');
        $memberType->description = $request->get('description');

        $memberType->save();

        return redirect()->route('admin_membertype_list')->with('success', 'The change you have made has been saved.');
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
        $memberType = MemberType::find($id);
        $memberType->delete();

        return redirect()->route('admin_membertype_list')->with('success', $memberType->name.' has been removed as a Membership Type.');
    }
}
