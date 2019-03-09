<?php

namespace App;

use App\Client;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table    = 'payment';
    protected $fillable = ['reference', 'description', 'currency', 'total', 'id_client',
    ];

    public function client()
    {

        return $this->hasOne(Client::class, 'id', 'id_client', 'name');
    }
}
