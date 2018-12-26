<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\RegisterPage;


class RegisterTest extends DuskTestCase
{
    /**
     * test login validations
     * @throws \Throwable
     */

    public function testRegisterUserValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(RegisterPage::REGISTER_URL)
                ->press('Register')
                ->pause(100)
                ->assertSee('The name field is required.')
                ->assertSee('The email field is required.')
                ->assertSee('The password field is required.');
        });

        $this->browse(function (Browser $browser) {
            $browser
                ->visit(RegisterPage::REGISTER_URL)
                ->type('email', RegisterPage::USER_EMAIL)
                ->press('Register')
                ->pause(100)
                ->assertSee('The password field is required.');
        });

        $this->browse(function (Browser $browser) {
            $browser
                ->visit(RegisterPage::REGISTER_URL)
                ->type('email', RegisterPage::USER_EMAIL)
                ->press('Register')
                ->pause(100)
                ->assertSee('The password field is required.');
        });

        $this->browse(function (Browser $browser) {
            $browser
                ->visit(RegisterPage::REGISTER_URL)
                ->type('password', RegisterPage::USER_PASS)
                ->press('Register')
                ->pause(100)
                ->assertSee('The email field is required.');
        });

        $this->browse(function (Browser $browser) {
            $browser
                ->visit(RegisterPage::REGISTER_URL)
                ->type('email', RegisterPage::WRONG_USER_EMAIL)
                ->type('password', RegisterPage::WRONG_USER_PASS)
                ->press('Register')
                ->pause(100)
                ->assertSee('The name field is required.');
        });



    }

    /**
     * test login
     * @throws \Throwable
     */
    public function testRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(RegisterPage::REGISTER_URL)
                ->type('name', RegisterPage::USER_NAME)
                ->type('email', RegisterPage::USER_EMAIL)
                ->type('password', RegisterPage::USER_PASS)
                ->type('password_confirmation', RegisterPage::USER_PASS)
                ->press('Register')
                ->waitForLocation(RegisterPage::HOME_URL)
                ->assertUrlIs(RegisterPage::homeUrl())
                ->assertSee(RegisterPage::HOME_ASSERT_STRING_1)
                ->assertSee(RegisterPage::HOME_ASSERT_STRING_2);
        });
    }
}
