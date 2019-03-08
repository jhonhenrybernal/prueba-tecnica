<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table    = 'payments';
    protected $fillable = ['reference', 'description', 'amount', 'currency', 'total', 'id_client',
    ];
}
