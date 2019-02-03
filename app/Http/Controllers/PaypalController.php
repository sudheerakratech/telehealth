<?php

namespace App\Http\Controllers;

use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Srmklive\PayPal\Facades\PayPal;

class PaypalController extends Controller
{
    public function index(Request $request)
    {
        $provider = PayPal::setProvider('adaptive_payments');

        $shares = $this->splitShares($request->amount);

        $data = [
            'receivers'  => [
                [
                    'email' => 'demo_doctor@akrahealth.com',
                    'amount' => $shares['doctor'],
                    'primary' => true,
                ],
                [
                    'email' => 'ash.syed-facilitator@gmail.com',
                    'amount' => $shares['akra'],
                    'primary' => false
                ]
            ],
            'payer' => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => url('/process_paid/?'.http_build_query($request->except('_token')).''),
            'cancel_url' => url('/home'),
        ];

        // temp
        return redirect('process_paid/?'.http_build_query($request->except('_token')).'');

        $response = $provider->createPayRequest($data);

        $redirect_url = $provider->getRedirectUrl('approved', $response['payKey']);

        return redirect($redirect_url);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function processPaid(Request $request)
    {
        $user_data = $request->query();

        Payment::create([
            'patient_id'    =>  \Auth::user()->id,
            'doctor_id' =>  $user_data['doctor'],
            'amount'    =>  $user_data['amount'],
            'person'    =>  $user_data['person'],
            'session_from'  => Carbon::now(),
            'session_to'  => Carbon::now()->addMinutes($user_data['session']),
            'room_id'   => $user_data['room']
        ]);

        return redirect('my-appointments');
    }

    private function splitShares($amount)
    {
        $akra = number_format((($amount * 2.5) / 100), 2);

        return [
            'doctor'    => number_format($amount - $akra, 2),
            'akra'      => $akra
        ];
    }
}
