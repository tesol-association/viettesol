<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Membership;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\Payer;
use PayPal\Api\PaymentExecution;

class PaymentController extends HomeController
{
    private $apiContext;
    private $itemList;
    private $paymentCurrency;
    private $totalAmount;
    private $returnUrl;
    private $cancelUrl;

    public function getPaymentForm()
    {
    	return view('layouts.home.service.payment');
    }

    public function getPaymentDetail(Request $request)
    {
    	$request->validate([
    		'mscode' => 'required'
    	]);
    	
    	$mscode = $request->get('mscode');
    	$member = Membership::where('mscode', $mscode)->first();
    	$contact = Contact::where('id', $member->contact_id)->first();

    	$unit = $member->msType->fee;
        $time = abs( strtotime( $member->end_date) - strtotime($member->start_date ) );
        $time = floor($time / (60 * 60 * 24));
        $fee = $unit * $time;

        $status = $member->is_paid;


    	return view('layouts.home.service.payment_report', [ 'contact' => $contact, 'fee' => $fee, 'status' => $status ]);
    }

    public function getPaymentDealForm($id)
    {
        $member = Membership::find($id);
        $unit = $member->msType->fee;
        $time = abs( strtotime( $member->end_date) - strtotime($member->start_date ) );
        $time = floor($time / (60 * 60 * 24));
        $fee = $unit * $time;

        return view('layouts.home.service.payment_deal', [ 'member' => $member, 'fee' => $fee ]);
    }
    
    public function paypalConstruct()
    {
        $paypalConfigs = config('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $paypalConfigs['client_id'],
                $paypalConfigs['secret']
            )
        );
        $this->paymentCurrency = "USD";
        $this->totalAmount = 0;
    }

    public function pay($id)
    {
        $member = Membership::find($id);
        $unit = $member->msType->fee;
        $time = abs( strtotime( $member->end_date) - strtotime($member->start_date ) );
        $time = floor($time / (60 * 60 * 24));
        $fee = $unit * $time;

        $this->paypalConstruct();

        $checkoutUrl = false;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $this->itemList = new ItemList();

        $amount = new Amount();
        $amount->setCurrency('USD')
               ->setTotal($fee);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription('Membership Maintainance Fee');

        $redirectUrls = new RedirectUrls();
        if (is_null($this->cancelUrl)) {
            $this->cancelUrl = $this->returnUrl;
        }

        $redirectUrls->setReturnUrl($this->returnUrl)
                     ->setCancelUrl($this->cancelUrl);

        $payment = new Payment();
        $payment->setIntent('Fee')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);

        try 
        {
            $payment->create($this->apiContext);
        } 
        catch (\PayPal\Exception\PPConnectionException $paypalException) 
        {
            throw new \Exception($paypalException->getMessage());
        }

        foreach ($payment->getLinks() as $link) 
        {
            if ($link->getRel() == 'approval_url') 
            {
                $checkoutUrl = $link->getHref();
                session(['paypal_payment_id' => $payment->getId()]);

                break;
            }
        }

        $paymentStatus = $this->getPaymentStatus();
        $paymentStatus2 = json_decode($paymentStatus, true);

        return view('layouts.home.service.payment_done', [ 'checkoutUrl' => $checkoutUrl,  'paymentStatus' => $paymentStatus2]);
    }

    public function getPaymentStatus()
    {
        //$request = Request::all();

        $paymentId = session('paypal_payment_id');
        session()->forget('paypal_payment_id');

        if (empty($request['PayerID']) || empty($request['token'])) 
        {
            return false;
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $paymentExecution = new PaymentExecution();
        $paymentExecution->setPayerId($request['PayerID']);

        $paymentStatus = $payment->execute($paymentExecution, $this->apiContext);

        return $paymentStatus;
    }
    
}
