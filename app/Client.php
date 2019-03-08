<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table    = 'clients';
    protected $fillable = ['document', 'documentType', 'name', 'surname', 'email', 'address',
    ];
}
