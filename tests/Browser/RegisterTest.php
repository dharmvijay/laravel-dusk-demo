<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\ExpectationFailedException;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\RegisterPage;
use Exception;


class RegisterTest extends DuskTestCase
{

    /**
     * test login validations
     * @throws \Throwable
     */
    public function testRegisterUserFormValidation()
    {
        $this->browse(function (Browser $browser) {
            try{
                $browser->visit(RegisterPage::REGISTER_URL);
                $browser->press('Register');
                $browser->pause(200);
                $browser->assertSee('The name field is required.');
                $browser->assertSee('The email field is required.');
                $browser->assertSee('The password field is required.')->pause(200);
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
                $browser->visit(RegisterPage::REGISTER_URL);
                $browser->type('email', RegisterPage::USER_EMAIL);
                $browser->press('Register');
                $browser->pause(200);
                $browser->assertSee('The password field is required.')->pause(200);
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
                $browser->visit(RegisterPage::REGISTER_URL);
                $browser->type('email', RegisterPage::USER_EMAIL);
                $browser->press('Register');
                $browser->pause(200);
                $browser->assertSee('The password field is required.')->pause(200);
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
                $browser->visit(RegisterPage::REGISTER_URL);
                $browser->type('password', RegisterPage::USER_PASS);
                $browser->press('Register');
                $browser->pause(200);
                $browser->assertSee('The email field is required.')->pause(200);
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
                $browser->visit(RegisterPage::REGISTER_URL);
                $browser->type('email', RegisterPage::WRONG_USER_EMAIL);
                $browser->type('password', RegisterPage::WRONG_USER_PASS);
                $browser->press('Register');
                $browser->pause(200);
                $browser->assertSee('The name field is required.')->pause(200);
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
     * test registration
     * @throws \Throwable
     */
    public function testRegister()
    {
        try{
            $this->browse(function (Browser $browser) {
                $browser->visit(RegisterPage::REGISTER_URL);
                $browser->type('name', RegisterPage::USER_NAME);
                $browser->type('email', RegisterPage::USER_EMAIL);
                $browser->type('password', RegisterPage::USER_PASS);
                $browser->type('password_confirmation', RegisterPage::USER_PASS);
                $browser->press('Register');
                $browser->waitForLocation(RegisterPage::HOME_URL);
                $browser->assertUrlIs(RegisterPage::homeUrl());
                $browser->assertSee(RegisterPage::HOME_ASSERT_STRING_1);
                $browser->assertSee(RegisterPage::HOME_ASSERT_STRING_2)->pause(500);
            });
        } catch (ExpectationFailedException $ex){
            $this->exceptionLogging($ex);
            throw $ex;
        } catch (Exception $ex) {
            $this->exceptionLogging($ex);
            throw $ex;
        }
    }
}
