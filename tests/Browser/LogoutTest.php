<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\LoginPage;


class LogoutTest extends DuskTestCase
{
    /**
     * test login
     * @throws \Throwable
     */
    public function testLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(LoginPage::LOGIN_URL)
                ->type('email', LoginPage::USER_EMAIL)
                ->type('password', LoginPage::USER_PASS)
                ->press('Login')
                ->waitForLocation(LoginPage::HOME_URL)
                ->assertUrlIs(LoginPage::homeUrl())
                ->assertSee(LoginPage::HOME_ASSERT_STRING_1)
                ->assertSee(LoginPage::HOME_ASSERT_STRING_2)
                ->click('#navbarDropdown')
                ->click('a.dropdown-item')->pause(200);
        });
    }
}
