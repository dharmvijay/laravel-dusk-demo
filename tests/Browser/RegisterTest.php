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
                RegisterPage::assertFullFormValidation($browser);
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
                RegisterPage::assertPasswordValidation($browser);
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
                RegisterPage::assertNameValidation($browser);
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
                RegisterPage::assertEmailValidation($browser);
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
        $this->browse(function (Browser $browser) {

            try{
                RegisterPage::assertRegister($browser);

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
