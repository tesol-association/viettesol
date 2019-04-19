<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends HomeController
{
    public function getPaymentForm()
    {
    	return view('layouts.home.service.payment');
    }
}
