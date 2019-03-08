<?php

namespace App\Http\Controllers;

use App\Authentication as AuthAccess;
use GuzzleHttp\Client;

class ProcessPaymentController extends Controller
{

    public function __construct()
    {
        $this->oClient = new Client(['verify' => false, 'headers' => ['Content-Type' => 'application/json']]);
        $this->sUrlPay = 'https://test.placetopay.com/redirection';
    }

    public function processPayment($data)
    {
        $reference = 'TEST_' . time();
        $auth      = new AuthAccess;
        $request   = json_encode([
            "auth"       => $auth->getAuth(),
            "locale"     => "en_US",
            "buyer"      => [
                "document"     => $data['document'],
                "documentType" => $data['documentType'],
                "name"         => $data['name'],
                "surname"      => $data['surname'],
                "email"        => $data['email'],
                "address"      => [
                    "street"  => $data['street'],
                    "city"    => $data['city'],
                    "country" => $data['country'],
                ],
            ],
            "payment"    => [
                "reference"   => $data['reference'],
                "description" => $data['description'],
                "amount"      => [
                    "currency" => "COP",
                    "total"    => $data['total'],
                ],
            ],
            "expiration" => date('c', strtotime('+1 hour')),
            "returnUrl"  => "http://pruebatecnicaplace.local.com/test",
            "ipAddress"  => "127.0.0.1",
            "userAgent"  => "PlacetoPay Sandbox",

        ]);
        $client  = new Client(['verify' => true, 'headers' => ['Content-Type' => 'application/json']]);
        $request = $client->post($this->sUrlPay . '/api/session', ['body' => $request]);
        return json_decode($request->getBody()->getContents(), true);
    }
}
