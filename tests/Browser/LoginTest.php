<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\ExpectationFailedException;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\LoginPage;
use Exception;

class LoginTest extends DuskTestCase
{
    /**
     * test login validations
     * @throws \Throwable
     */

    public function testLoginValidation()
    {
        $this->browse(function (Browser $browser) {
            try{
                $browser->visit(LoginPage::LOGIN_URL);
                Log::info('[testLoginValidation]: visited login page');

                $browser->press('Login');
                Log::info('[testLoginValidation]: Hit login button without entering any value to test client side validations.');

                $browser->pause(200);
                $browser->assertSee('The email field is required.');
                $browser->assertSee('The password field is required.')->pause(200);
                Log::info('[testLoginValidation]: Field Validations executed successfully.');

            } catch (ExpectationFailedException $ex){
                $this->exceptionLogging($ex);
                throw $ex;
            } catch (Exception $ex) {
                $this->exceptionLogging($ex);
                throw $ex;
            }

        });

        $this->browse(function (Browser $browser) {
            try{
                $browser->visit(LoginPage::LOGIN_URL);
                Log::info('[testLoginValidation]: Visited login page');

                $browser->type('email', LoginPage::USER_EMAIL);
                Log::info('[testLoginValidation]: Entered in email address field and password kept blank.');

                $browser->press('Login');
                Log::info('[testLoginValidation]: Hit login button to check password required validation.');

                $browser->pause(200);
                $browser->assertSee('The password field is required.')->pause(200);
                Log::info('[testLoginValidation]: Password Field validation test executed successfully.');

            } catch (ExpectationFailedException $ex){
                $this->exceptionLogging($ex);
                throw $ex;
            } catch (Exception $ex) {
                $this->exceptionLogging($ex);
                throw $ex;
            }

        });

        $this->browse(function (Browser $browser) {
            try{
                $browser->visit(LoginPage::LOGIN_URL);
                Log::info('[testLoginValidation]: Visited login page');

                $browser->type('password', LoginPage::USER_PASS);
                Log::info('[testLoginValidation]: Entered in password field and email field kept blank.');

                $browser->press('Login');
                Log::info('[testLoginValidation]: Hit login button to check email required validation.');

                $browser->pause(200);
                $browser->assertSee('The email field is required.')->pause(200);
                Log::info('[testLoginValidation]: Email Field validation test executed successfully.');

            } catch (ExpectationFailedException $ex){
                $this->exceptionLogging($ex);
                throw $ex;
            } catch (Exception $ex) {
                $this->exceptionLogging($ex);
                throw $ex;
            }
        });

        $this->browse(function (Browser $browser) {
            try{
                $browser->visit(LoginPage::LOGIN_URL);
                Log::info('[testLoginValidation]: Visited login page');

                $browser->type('email', LoginPage::WRONG_USER_EMAIL);
                $browser->type('password', LoginPage::WRONG_USER_PASS);
                Log::info('[testLoginValidation]: Entered wrong values in email and password field');

                $browser->press('Login');
                Log::info('[testLoginValidation]: Hit login button to authenticate.');

                $browser->pause(200);
                $browser->assertSee('These credentials do not match our records.')->pause(200);
                Log::info('[testLoginValidation]: Enter wrong values validation test executed successfully.');

            } catch (ExpectationFailedException $ex){
                $this->exceptionLogging($ex);
                throw $ex;
            } catch (Exception $ex) {
                $this->exceptionLogging($ex);
                throw $ex;
            }

        });
    }

    /**
     * test login
     * @throws \Throwable
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            try{
                $browser->visit(LoginPage::LOGIN_URL);
                Log::info('[testLogin]: Visited login page');

                $browser->type('email', LoginPage::USER_EMAIL);
                $browser->type('password', LoginPage::USER_PASS);
                Log::info('[testLogin]: Entered valid values in email and password field and email field kept blank.');

                $browser->press('Login');
                Log::info('[testLogin]: Hit login button to authenticate.');

                $browser->waitForLocation(LoginPage::HOME_URL);
                Log::info('[testLogin]: Wait until user gets authenticated successfully and redirect to home page.');

                $browser->assertUrlIs(LoginPage::homeUrl());
                $browser->assertSee(LoginPage::HOME_ASSERT_STRING_1);
                $browser->assertSee(LoginPage::HOME_ASSERT_STRING_2)->pause(200);
                Log::info('[testLogin]: Enter wrong values validation test executed successfully.');

            } catch (ExpectationFailedException $ex){
                $this->exceptionLogging($ex);
                throw $ex;
            } catch (Exception $ex) {
                $this->exceptionLogging($ex);
                throw $ex;
            }

        });
    }
}
