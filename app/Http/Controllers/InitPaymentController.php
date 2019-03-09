<?php

namespace App\Http\Controllers;

use App\Client;
use App\Payment;
use App\RequestPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class InitPaymentController extends Controller
{
    //nuevo pago y envio a rest
    public function makePayment(Request $request)
    {
        if (!empty($request)) {

            $clientCreate               = new Client;
            $clientCreate->document     = $request['documento'];
            $clientCreate->documentType = $request['documentType'];
            $clientCreate->name         = $request['name'];
            $clientCreate->surname      = $request['surname'];
            $clientCreate->email        = $request['email'];
            $clientCreate->address      = $request['street'] . ' ' . $request['city'] . ' ' . $request['country'] . ' ' . $request['mobile'];
            $clientCreate->save();

            $clientId                   = $clientCreate->id;
            $paymentCreate              = new Payment;
            $paymentCreate->reference   = $request['reference'];
            $paymentCreate->description = $request['description'];
            $paymentCreate->currency    = 'COP';
            $paymentCreate->total       = $request['total'];
            $paymentCreate->id_client   = $clientId;

            $paymentCreate->save();

            $idPay = $paymentCreate->id;

            if (empty($clientId) and empty($idPay)) {
                return \Redirect::back()->withInput($request->all())->with('error', 'Error procesar el pago por favor contacte con el administrador del sistema');
            } else {

                $reponseRest = $this->paymentRest()->processPayment($request, $idPay);

                $requestPaymentCreate             = new RequestPayment;
                $requestPaymentCreate->status     = $reponseRest['status']['status'];
                $requestPaymentCreate->message    = $reponseRest['status']['message'];
                $requestPaymentCreate->date       = $reponseRest['status']['date'];
                $requestPaymentCreate->requestId  = $reponseRest['requestId'];
                $requestPaymentCreate->payment_id = $idPay;
                $requestPaymentCreate->save();

                if ($reponseRest['status']['status'] = 'OK') {
                    $result = [
                        'result'  => true,
                        'mensaje' => 'Sera direccionado a pagos placetopay ' . $reponseRest['status']['message'],
                        'url'     => $reponseRest['processUrl'],
                    ];
                    return response()->json($result);

                } elseif ($reponseRest['status']['status'] = 'FAILED') {
                    $result = [
                        'result'  => false,
                        'mensaje' => $reponseRest['status']['message'],
                    ];
                    return response()->json($result);

                }
            }

        } else {
            $result = [
                'result'  => false,
                'mensaje' => 'Error procesar el pago por favor contacte con el administrador del sistema',
            ];
            return response()->json($result);
        }
    }

    //consultas
    public function returnRest($id)
    {
        $decrypted = Crypt::decrypt($id);

        $id_pay      = RequestPayment::where('payment_id', $decrypted)->first();
        $reponseRest = $this->paymentRest()->statusPayment($id_pay['requestId']);
        $payment     = Payment::find($decrypted);

        if ($reponseRest['status']['status'] = 'APPROVED') {
            $estado = true;
        } else {
            $estado = false;
        }
        $respons = [
            'estado'      => $reponseRest['status']['status'],
            'descripcion' => $reponseRest['request']['payment']['description'],
            'nombre'      => $payment->client->name,
            'alert'       => $estado,
        ];

        return view('respuestaPago', ['response' => $respons]);
    }
}
