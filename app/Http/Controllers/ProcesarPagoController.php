<?php

namespace App\Http\Controllers;

use App\Authentication as AuthAccess;
use GuzzleHttp\Client;

class ProcessPaymentController extends Controller
{
    protected $login;

    protected $tranKey;

    protected $seed;

    protected $nonce;

    public function __construct()
    {
        $this->oClient = new Client(['verify' => false, 'headers' => ['Content-Type' => 'application/json']]);
        $this->sUrlPay = 'https://test.placetopay.com/redirection';

        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }
        $this->secretKey = '024h1IlD';
        $this->login     = '6dd490faf9cb87a9862245da41170ff2';
        $this->seed      = date('c');
        $this->nonce     = base64_encode($nonce);
        $this->tranKey   = base64_encode(sha1($nonce . $this->seed . $this->secretKey, true));

    }

    public function processPayment()
    {
        $reference = 'TEST_' . time();
        $auth      = new AuthAccess;
        $request   = json_encode([
            "auth"       => $auth->getAuth(),
            "locale"     => "en_US",
            "buyer"      => [
                "document"     => "1040030020",
                "documentType" => "CC",
                "name"         => "John",
                "surname"      => "Doe",
                "email"        => "johndoe@example.com",
                "address"      => [
                    "street"  => "742 Evergreen Terrace",
                    "city"    => "Springfield",
                    "country" => "US",
                ],
            ],
            "payment"    => [
                "reference"   => "5976030f5575d",
                "description" => "Pago básico de prueba",
                "amount"      => [
                    "currency" => "COP",
                    "total"    => "10000",
                ],
            ],
            "expiration" => date('c', strtotime('+1 hour')),
            "returnUrl"  => "http://pruebatecnicaplace.local.com/test",
            "ipAddress"  => "127.0.0.1",
            "userAgent"  => "PlacetoPay Sandbox",

        ]);
        $client = new Client(['verify' => true, 'headers' => ['Content-Type' => 'application/json']]);
// Send a request to https://foo.com/api/test
        $request = $client->post($this->sUrlPay . '/api/session', ['body' => $request]);
        return json_decode($request->getBody()->getContents(), true);
    }
}
