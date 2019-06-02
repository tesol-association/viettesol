<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MembershipType;
use App\Models\Membership;
use App\Models\Contact;
use App\Model\Conference;

use Session;
use Mail;

class ConferenceNotification extends Controller
{
	var $email;

	function __construct(Conference $conf)
	{
		$contacts = Contact::all();

		foreach( $contacts as $contact )
		{
			$this->sendMail($contact, $conf);
		}
	}

	function sendMail(Contact $contact, Conference $conf)
	{
		$url = '/conference/'.$conf->path.'/home';
		$this->email = $contact->email;

		Mail::send('emails/conference_noti', 
			array(
				'first_name' => $contact->first_name,
                'middle_name' => $contact->middle_name,
                'last_name' => $contact->last_name,
                'title' => $conf->title,
                'link' => $url,
                'slogan' => $conf->slogan;
			), 
			function($message)
			{
				$message->to($this->email, 'VietteSOL')->subject('VietteSOL Conference Announcement');
			});
	}
}