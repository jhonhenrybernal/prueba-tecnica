<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestPayment extends Model
{
    protected $table    = 'RequestPayment';
    protected $fillable = ['status', 'message', 'date', 'requestId', 'payment_id',
    ];
}
