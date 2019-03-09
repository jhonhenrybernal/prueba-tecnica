<?php

namespace App\Http\Controllers;

use App\Authentication as AuthAccess;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Crypt;

class ProcessPaymentController extends Controller
{
    //conexion url
    public function __construct()
    {
        $this->oClient = new Client(['verify' => false, 'headers' => ['Content-Type' => 'application/json']]);
        $this->sUrlPay = 'https://test.placetopay.com/redirection';

    }

    //instanciamiento a envio
    public function processPayment($data, $idPay)
    {
        $reference = 'TEST_' . time();
        $auth      = new AuthAccess;
        $request   = json_encode([
            "auth"       => $auth->getAuth(),
            "locale"     => "en_US",
            "buyer"      => [
                "document"     => (string) $data['documento'],
                "documentType" => (string) $data['documentType'],
                "name"         => $data['name'],
                "surname"      => $data['surname'],
                "email"        => $data['email'],
                "mobile"       => $data['mobile'],
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
                    "total"    => (int) $data['total'],
                ],
            ],
            "expiration" => date('c', strtotime('+1 hour')),
            "returnUrl"  => "http://pruebatecnicaplace.local.com/api/estado/pago/" . Crypt::encrypt($idPay),
            "ipAddress"  => "127.0.0.1",
            "userAgent"  => "PlacetoPay Sandbox",

        ]);

        $client = new Client(['verify' => true, 'headers' => ['Content-Type' => 'application/json']]);
        //seleccion meotodo de envio
        $request = $client->post($this->sUrlPay . '/api/session', ['body' => $request]);
        return json_decode($request->getBody()->getContents(), true);
    }

    //consulta
    public function statusPayment($id)
    {

        $auth    = new AuthAccess;
        $request = json_encode([
            "auth" => $auth->getAuth(),
        ]);

        $client = new Client(['verify' => true, 'headers' => ['Content-Type' => 'application/json']]);
        //seleccion meotodo de envio
        $request = $client->post($this->sUrlPay . '/api/session/' . $id, ['body' => $request]);

        return json_decode($request->getBody()->getContents(), true);
    }
}
