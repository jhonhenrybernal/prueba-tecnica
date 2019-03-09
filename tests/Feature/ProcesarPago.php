<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProcesarPago extends TestCase
{

    /** @test */
    public function procesar()
    {
        $credentials = [
            "name"         => 'prueba bernal',
            "lastName"     => "bernalles",
            "documentType" => "CC",
            "document"     => "",
            "surname"      => "jbernalres",
            "email"        => "bjbernal@mail.com",
            "address"      => "calle 12 # 12 -00",
            "reference"    => "123456",
            "description"  => "prueba unit",
            "total"        => "100000",
            "mobile"       => "31343343554",

        ];

        $response = $this->from('procesar/pago')->post('procesar/pago', $credentials);
        $response->assertRedirect('procesar/pago')->assertSessionHasErrors([

        ]);
    }
}
