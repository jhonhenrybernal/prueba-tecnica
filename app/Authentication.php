<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{

    protected $login;

    protected $tranKey;

    protected $seed;

    protected $additional;

    public function __construct()
    {
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

    public function getAuth($isFlat = true)
    {

        return (array(
            "login"   => $this->login,
            "seed"    => $this->seed,
            "nonce"   => $this->nonce,
            "tranKey" => $this->tranKey,

        ));
    }
}
