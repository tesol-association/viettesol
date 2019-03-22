<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Contribution;

class ContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contributions = Contribution::all();

        return view('layouts.admin.contribution.list', ['contributions' => $contributions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'contact_id' => 'required',
            'amount' => 'required',
            'unit' => 'required',
            'payment_method_id' => 'required',
            'transacion_id' => 'required'
        ]);

        $contribution = new Contribution();
        $contribution->contact_id = $request->get('contact_id');
        $contribution->amount = $request->get('amount');
        $contribution->unit = $request->get('unit');
        $contribution->payment_method_id = $request->get('payment_method_id');
        $contribution->transaction_id = $request->get('transaction_id');

        $contribution->save();
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contribution = Contribution::find($id);
        $contribution->delete();

        return redirect()->route('admin_contribution_list')->with('success', 'A contribution history has been removed.');
    }
}
