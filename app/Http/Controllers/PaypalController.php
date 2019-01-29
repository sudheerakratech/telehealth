<?php

namespace App\Http\Controllers;

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
            'return_url' => url('home'),
            'cancel_url' => url('/home'),
        ];

        $response = $provider->createPayRequest($data);

        $redirect_url = $provider->getRedirectUrl('approved', $response['payKey']);

        return redirect($redirect_url);
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
