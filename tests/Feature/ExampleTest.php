<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
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

        $this->assertGuest($guard = null); //user is unauthenticated

        $url = URL::to('/');
        $response = $this->get($url);
        $response->assertStatus(302); //unauthenticated user will be redirected
        $response->assertSee("Redirecting to {$url}/login"); //redirect message

        $response2 = $this->get('/login');
        $response2->assertSee('E-Mail Address');
        $response2->assertSee('Password');

        $response2 = $this->get('/non/existant/page');
        $response2->assertStatus(404);
    }
}
