<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MembershipType;
use App\Models\Menu;
use App\Models\Partner;
use App\Models\Advertisement;

use App\Models\Membership;
use App\Models\Contact;

use Session;
use Mail;

class MemberRegistration extends Controller
{
    var $email;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menus = Menu::all();
        $partners = Partner::all();
        $advs = Advertisement::all();
        $msTypes = MembershipType::all();
        return view('layouts.home.service.member_done', [ 'msTypes'=>$msTypes, 'menus' => $menus, 'partners' => $partners, 'advs' => $advs ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $menus = Menu::all();
        $partners = Partner::all();
        $advs = Advertisement::all();
        $msTypes = MembershipType::all();
        return view('layouts.home.service.member_register', [ 'msTypes'=>$msTypes, 'menus' => $menus, 'partners' => $partners, 'advs' => $advs ]);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:contacts',
            'end_date' => 'required'
        ]);

        $contact = new Contact();
        $member = new Membership();

        $contact->type_id = 1;
        $contact->first_name = $request->get('first_name');
        $contact->middle_name = $request->get('middle_name');
        $contact->last_name = $request->get('last_name');
        $contact->email = $request->get('email');
        $contact->address = $request->get('address');
        $contact->phone = $request->get('phone');
        $contact->fax = $request->get('fax');
        $contact->country = $request->get('country');
        $contact->website = $request->get('website');

        $contact->save();

        $member->contact_id = $contact->id;
        $member->type_id = $request->get('payfor');
        $member->mscode = $this->codeGenerate();
        $member->start_date = date('Y-m-d', time());
        $member->end_date = $request->get('end_date');

        $member->save();

        $this->email = $contact->email;

        $this->sendMail($contact, $member);

        return redirect()->route('home_member_done');
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
        //
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

    public function sendMail(Contact $contact, Membership $member)
    {
        Mail::send('emails/member_signup', 
            array(
                'first_name' => $contact->first_name,
                'middle_name' => $contact->middle_name,
                'last_name' => $contact->last_name,
                'type' => $member->msType->name,
                'mscode' => $member->mscode,
                'end_date' => $member->end_date
            ), 
            function($message) 
            { 
                $message->to($this->email, 'VietteSOL')->subject('VietteSOL Membership Registration Feedback');
            } );
    }
}
