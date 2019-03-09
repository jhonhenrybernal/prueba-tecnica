<?php

namespace App;

use App\Payment;
use Illuminate\Database\Eloquent\Model;

class RequestPayment extends Model
{
    protected $table    = 'request_payment';
    protected $fillable = ['status', 'message', 'date', 'requestId', 'payment_id',
    ];

    public function payment()
    {

        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }
}
