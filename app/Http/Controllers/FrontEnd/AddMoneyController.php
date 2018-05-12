<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AddMoneyController extends Controller
{
    public function payment(){
        return view('FrontEnd.payment');
    }
    public function stripePay(Request $request)
    {
        \Stripe\Stripe::setApiKey ( 'sk_test_jS9iWrFIXGfdf6jfVbJQdaJg' );
        try {
            \Stripe\Charge::create ( array (
                "amount" => 300 * 100,
                "currency" => "usd",
                "source" => $request->input ( 'stripeToken' ), // obtained with Stripe.js
                "description" => "Test payment."
            ) );
            Session::flash ( 'success-message', 'Payment done successfully !' );
            return Redirect::back ();
        } catch ( \Exception $e ) {
            Session::flash ( 'fail-message', "Error! Please Try again." );
            return Redirect::back ();
        }
    }
}
