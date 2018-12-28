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
                Log::info('[testRegisterUserFormValidation]: Visited registration page.');

                $browser->press('Register');
                Log::info('[testRegisterUserFormValidation]: Hit register button to authenticate.');

                $browser->pause(200);
                $browser->assertSee('The name field is required.');
                $browser->assertSee('The email field is required.');
                $browser->assertSee('The password field is required.')->pause(200);
                Log::info('[testRegisterUserFormValidation]: Validation message assertions seems fine.');
                Log::info('[testRegisterUserFormValidation]: Field Validations executed successfully.');


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
                Log::info('[testRegisterUserFormValidation]: Visited registration page.');

                $browser->type('email', RegisterPage::USER_EMAIL);
                $browser->press('Register');
                Log::info('[testRegisterUserFormValidation]: Hit register button to authenticate.');

                $browser->pause(200);
                $browser->assertSee('The password field is required.')->pause(200);
                Log::info('[testRegisterUserFormValidation]: Register form validation assertions seems fine.');

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
                Log::info('[testRegisterUserFormValidation]: Visited registration page.');

                $browser->type('email', RegisterPage::USER_EMAIL);
                $browser->press('Register');
                Log::info('[testRegisterUserFormValidation]: Hit register button to authenticate.');

                $browser->pause(200);
                $browser->assertSee('The password field is required.')->pause(200);
                Log::info('[testRegisterUserFormValidation]: Register form validation assertions seems fine.');

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
                Log::info('[testRegisterUserFormValidation]: Visited registration page.');

                $browser->type('password', RegisterPage::USER_PASS);
                $browser->press('Register');
                Log::info('[testRegisterUserFormValidation]: Hit register button to authenticate.');

                $browser->pause(200);
                $browser->assertSee('The email field is required.')->pause(200);
                Log::info('[testRegisterUserFormValidation]: Register form validation assertions seems fine.');

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
                Log::info('[testRegisterUserFormValidation]: Visited registration page.');

                $browser->type('email', RegisterPage::WRONG_USER_EMAIL);
                $browser->type('password', RegisterPage::WRONG_USER_PASS);
                $browser->press('Register');
                Log::info('[testRegisterUserFormValidation]: Hit register button to authenticate.');

                $browser->pause(200);
                $browser->assertSee('The name field is required.')->pause(200);
                Log::info('[testRegisterUserFormValidation]: Register form validation assertions seems fine.');

            } catch (ExpectationFailedException $ex){
                $this->exceptionLogging($ex);
                throw $ex;
            } catch (Exception $ex) {
                $this->exceptionLogging($ex);
                throw $ex;
            }
        });
        Log::info('[testRegister]: Validate Registration test cases executed successfully.');

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
                Log::info('[testRegister]: Visited registration page.');

                $browser->type('name', RegisterPage::USER_NAME);
                $browser->type('email', RegisterPage::USER_EMAIL);
                $browser->type('password', RegisterPage::USER_PASS);
                $browser->type('password_confirmation', RegisterPage::USER_PASS);
                Log::info('[testRegister]: Entered all valid details as exacting it register successfully.');

                $browser->press('Register');
                Log::info('[testRegister]: Hit register button to authenticate.');

                $browser->waitForLocation(RegisterPage::HOME_URL);
                Log::info('[testRegister]: Wait until registration done and redirect to home page.');

                $browser->assertUrlIs(RegisterPage::homeUrl());
                $browser->assertSee(RegisterPage::HOME_ASSERT_STRING_1);
                $browser->assertSee(RegisterPage::HOME_ASSERT_STRING_2)->pause(500);
                Log::info('[testRegister]: Registration assertions seems fine.');
                Log::info('[testRegister]: Registration test cases executed successfully.');

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
