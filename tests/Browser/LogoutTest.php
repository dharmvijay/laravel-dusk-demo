<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\ExpectationFailedException;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\LoginPage;


class LogoutTest extends DuskTestCase
{
    /**
     * test logout
     * @throws \Throwable
     */
    public function testLogout()
    {
        $this->browse(function (Browser $browser) {
            try{
                $browser->visit(LoginPage::LOGIN_URL);
                Log::info('[testLogout]: Visited login page.');

                $browser->type('email', LoginPage::USER_EMAIL);
                Log::info('[testLogout]: Entered email address.');

                $browser->type('password', LoginPage::USER_PASS);
                Log::info('[testLogout]: Entered password.');

                $browser->press('Login');
                Log::info('[testLogout]: Hit login button to authenticate.');

                $browser->waitForLocation(LoginPage::HOME_URL);
                Log::info('[testLogout]: Wait until it authenticate and redirect to home page.');

                $browser->assertUrlIs(LoginPage::homeUrl());
                $browser->assertSee(LoginPage::HOME_ASSERT_STRING_1);
                $browser->assertSee(LoginPage::HOME_ASSERT_STRING_2);
                Log::info('[testLogout]: Assert current url is home page url and other content.');

                $browser->click('#navbarDropdown');
                $browser->click('a.dropdown-item')->pause(200);
                Log::info('[testLogout]: Hit logout link.');

                $browser->assertSee('Laravel');
                Log::info('[testLogout]: Assert to see home content of "laravel".');

            } catch (ExpectationFailedException $ex){
                $this->exceptionLogging($ex);
                throw $ex;
            } catch (\Exception $ex) {
                $this->exceptionLogging($ex);
                throw $ex;
            }

        });
    }
}
