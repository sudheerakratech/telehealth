<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Facades\PayPal;

class PaypalController extends Controller
{
    public function index(Request $request)
    {
        $provider = PayPal::setProvider('adaptive_payments');

        $data = [
            'receivers'  => [
                [
                    'email' => 'johndoe@example.com',
                    'amount' => 10,
                    'primary' => true,
                ],
                [
                    'email' => 'janedoe@example.com',
                    'amount' => 5,
                    'primary' => false
                ]
            ],
            'payer' => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => url('payment/success'),
            'cancel_url' => url('payment/cancel'),
        ];

        $response = $provider->createPayRequest($data);
  
        $redirect_url = $provider->getRedirectUrl('approved', $response['payKey']);

        return redirect($redirect_url);
    }
}
