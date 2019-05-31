<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailController extends BaseConferenceController
{
    public function show()
    {
        return view('layouts.admin.mailchimp.show');
    }

    public function notification(Request $request){
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //List ID from .env
        $listId = env('MAILCHIMP_LIST_ID');

        //Mailchimp instantiation with Key
        $mailchimp = new \Mailchimp(env('MAILCHIMP_KEY'));

        //Create a Campaign $mailchimp->campaigns->create($type, $options, $content)
        $campaign = $mailchimp->campaigns->create('regular', [
            'list_id' => $listId,
            'subject' => $request->email_subject,
            'from_email' => $request->email_from,
            'from_name' => env('MAIL_FROM_NAME'),
            'to_name' => env('MAIL_FROM_NAME')

        ], [
//            'html' => $request->input('content'),
//            'text' => strip_tags($request->input('content'))
            'html' => $request->email_body,
//            'text' => strip_tags('ddddd')
        ]);

        //Send campaign
        $mailchimp->campaigns->send($campaign['id']);

        return redirect()->back()->with('success', 'Send All User Successful');
    }

    public function validateData($data)
    {
        return Validator::make($data, [
            'email_from' => 'required',
            'email_subject' => 'required',
            'email_body' => 'required',
        ]);
    }
}
