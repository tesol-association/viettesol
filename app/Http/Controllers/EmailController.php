<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function notify(Request $request){

        //List ID from .env
        $listId = env('MAILCHIMP_LIST_ID');

        //Mailchimp instantiation with Key
        $mailchimp = new \Mailchimp(env('MAILCHIMP_KEY'));

        //Create a Campaign $mailchimp->campaigns->create($type, $options, $content)
        $campaign = $mailchimp->campaigns->create('regular', [
            'list_id' => $listId,
            'subject' => 'Test API MailChimp 11h04',
            'from_email' => 'viettesol@gmail.com',
            'from_name' => 'Viettesol',
            'to_name' => 'Viettesol'

        ], [
//            'html' => $request->input('content'),
//            'text' => strip_tags($request->input('content'))
            'html' => '<p>Test API Mail Chimp</p>',
//            'text' => strip_tags('ddddd')
        ]);

        //Send campaign
        $mailchimp->campaigns->send($campaign['id']);

        return response()->json(['status' => 'Success']);
    }
}
