<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\ExpectationFailedException;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Exception;

class InstallationTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @throws \Throwable
     */

    public function testLaravelInstallation()
    {
        $this->browse(function (Browser $browser) {
            try{
                $browser->visit('/');
                Log::info('Visited home view');

                $browser->assertSee('Laravel');
                Log::info('Asserted home content');

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
