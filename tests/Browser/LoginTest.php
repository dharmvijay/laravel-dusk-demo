<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\LoginPage;


class LoginTest extends DuskTestCase
{
    /**
     * test login validations
     * @throws \Throwable
     */

    public function testLoginValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(LoginPage::LOGIN_URL)
                ->press('Login')
                ->pause(200)
                ->assertSee('The email field is required.')
                ->assertSee('The password field is required.')->pause(200);
        });

        $this->browse(function (Browser $browser) {
            $browser
                ->visit(LoginPage::LOGIN_URL)
                ->type('email', LoginPage::USER_EMAIL)
                ->press('Login')
                ->pause(200)
                ->assertSee('The password field is required.')->pause(200);
        });

        $this->browse(function (Browser $browser) {
            $browser
                ->visit(LoginPage::LOGIN_URL)
                ->type('password', LoginPage::USER_PASS)
                ->press('Login')
                ->pause(200)
                ->assertSee('The email field is required.')->pause(200);
        });

        $this->browse(function (Browser $browser) {
            $browser
                ->visit(LoginPage::LOGIN_URL)
                ->type('email', LoginPage::WRONG_USER_EMAIL)
                ->type('password', LoginPage::WRONG_USER_PASS)
                ->press('Login')
                ->pause(200)
                ->assertSee('These credentials do not match our records.')->pause(200);
        });



    }

    /**
     * test login
     * @throws \Throwable
     */
    public function testLogin()
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
                ->assertSee(LoginPage::HOME_ASSERT_STRING_2)->pause(200);
        });
    }
}
