<?php

namespace Tests\Browser;

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
    public function testLoginFormValidation()
    {
        $this->browse(function (Browser $browser) {
            try{
                LoginPage::assertFullFormValidation($browser); // Assert to check full login form validation
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
                LoginPage::assertPassValidation($browser); // Assert to check password field validation
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
                LoginPage::assertEmailValidation($browser); // Assert to check email field validation
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
                LoginPage::assertInValidDataValidation($browser); // Assert to check wrong credentials validation
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
                LoginPage::assertLogin($browser);
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
