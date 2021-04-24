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
            $browser->type('email', 'admin2@admin.com');
            $browser->type('password', 'admin1234');
            $browser->press('Login');
            $browser->pause(1500);

            $browser->assertSee('Admin2 Adminovic2');

            $browser->click('a[href="/event-search"]');
            $browser->pause(2000);

            $browser->click('select');
            $browser->click('option[value="1"]');

            $browser->pause(1000);
            $browser->click("a[href='/event/1']");

            $browser->pause(1500);
            $browser->assertSee('Host: Admin Adminovic');



        });
    }
}