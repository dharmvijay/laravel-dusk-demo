<?php

namespace Tests\Browser;

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
                LoginPage::assertLogout($browser); // Check logout feature
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
