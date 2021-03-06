<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $credentials = [
            '_token'       => csrf_token(),
            "name"         => 'prueba bernal',
            "lastName"     => "bernalles",
            "documentType" => "CC",
            "document"     => "8978686768",
            "surname"      => "jbernalres",
            "email"        => "bjbernal@mail.com",
            "address"      => "calle 12 # 12 -00",
            "reference"    => "123456",
            "description"  => "prueba unit",
            "total"        => "100000",
            "mobile"       => "31343343554",

        ];

        $response = $this->json('POST', 'procesar/pago', $credentials);
        $response
            ->assertStatus(201)
            ->assertExactJson([
                'created' => true,
            ]);
    }
}
