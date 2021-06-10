<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->type('email', 'admin@admin.com');
            $browser->type('password', 'admin1234');
            $browser->press('Login');
            $browser->pause(1500);

            $browser->assertSee('Admin Adminovic');
        });
    }
}
