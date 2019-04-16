<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Services\Donation;
use Session;

class DonationController extends HomeController
{
    public function getPayPalForm()
    {
    	return view('layouts.home.service.paypal');
    }
}
