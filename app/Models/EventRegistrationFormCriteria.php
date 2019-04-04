<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistrationFormCriteria extends Model
{
	protected $table = "event_registration_form_criteria";

	protected $fillable =[
		'id', 'event_id', 'type', 'name', 'description', 'possible_values'
	];
}
