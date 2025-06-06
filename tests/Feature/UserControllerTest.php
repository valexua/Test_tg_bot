<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_users(): void
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
        
        $response->assertJsonStructure([
             [ 'id', 'Name', 'Subscribed' ]
        ]);


    }
}
