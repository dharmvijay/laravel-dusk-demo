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
                RegisterPage::assertFullFormValidation($browser); // Assert to check full registration form validation
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
                RegisterPage::assertPasswordValidation($browser); // Assert to check password field validation
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
                RegisterPage::assertNameValidation($browser); // Assert to check name field validation
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
                RegisterPage::assertEmailValidation($browser); // Assert to check email field validation
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
        $this->browse(function (Browser $browser) {

            try{
                RegisterPage::assertRegister($browser); // Assert to check registration feature
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
