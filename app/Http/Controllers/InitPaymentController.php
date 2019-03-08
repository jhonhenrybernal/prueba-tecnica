<?php

namespace App\Http\Controllers;

use App\Clients;
use App\Payment;
use App\RequestPayment;
use Illuminate\Http\Request;

class InitPaymentController extends Controller
{
    public function makePayment(Request $request)
    {
        $value = [
            'document' => 'required|max:255|unique:clients',
            'name'     => 'required|max:255',
            'surname'  => 'required|max:255|unique:clients',
            'email'    => 'required|email|max:255|unique:clients',

        ];

        $message = [
            'document.required' => 'El Documento es obligatorio',
            'name.required'     => 'El Nombre es obligatorio',
            'surname.required'  => 'El usuario de red es obligatorio',
            'email.required'    => 'El Email es obligatorio',
            'document.unique'   => 'El Documento ya existe',
            'surname.unique'    => 'El usuario de red ya existe',
            'email.unique'      => 'El Email ya existe',

        ];
        $validation = Validator::make(request()->all(), $rules, $messages);

        if (!$validation->fails()) {

            $clientCreate               = new Clients;
            $clientCreate->document     = $request['document'];
            $clientCreate->documentType = $request['documentType'];
            $clientCreate->name         = $request['name'];
            $clientCreate->surname      = $request['surname'];
            $clientCreate->email        = $request['email'];
            $clientCreate->address      = $request['street'] . ' ' . $request['city'] . ' ' . $request['country'];
            $clientCreate->save();

            $clientId = $clientCreate->id;

            $paymentCreate               = new Payment;
            $paymentCreate->document     = $request['reference'];
            $paymentCreate->documentType = $request['description'];
            $paymentCreate->name         = $request['amount'];
            $paymentCreate->surname      = $request['currency'];
            $paymentCreate->email        = $request['total'];
            $paymentCreate->address      = $clientId;
            $paymentCreate->save();

            $idPay = $paymentCreate->id;

            if (empty($clientId) and empty($idPay)) {
                return \Redirect::back()->withInput($request->all())->with('message', ['error', 'Error procesar el pago por favor contacte con el administrador del sistema']);
            } else {

                $reponseRest = $this->paymentRest()->processPayment($request);

                $response = json_decode($reponseRest);
                foreach ($response as $status) {
                    # code...
                }
                if ($status['status'] = 'ok') {

                    $requestPaymentCreate             = new RequestPayment;
                    $requestPaymentCreate->status     = $status['reference'];
                    $requestPaymentCreate->message    = $status['description'];
                    $requestPaymentCreate->date       = $status['amount'];
                    $requestPaymentCreate->requestId  = $status['currency'];
                    $requestPaymentCreate->payment_id = $status['total'];
                    $requestPaymentCreate->save();

                    return \Redirect::back()->withInput($request->all())->with('message', ['success', $response['status']['message']]);
                } elseif ($status['status'] = 'FAILED') {
                    return \Redirect::back()->withInput($request->all())->with('message', ['error', $response['status']['message']]);
                }

            }
        }
    }
}
