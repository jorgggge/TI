<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class companias extends TestCase
{
    public function una_compania_puede_agregarse()
    {
        $response = $this->post('/CreateCompany/addCompany/create'.
            [
                'name'=>'Aeromexico',
                'address'=>'aeropuerto',
                'phoneNumber'=>'654987321',
                'email'=>'asd@asddd.com'
            ]);
        $response->assertOk();
    }
}
