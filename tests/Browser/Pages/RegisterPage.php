<?php

namespace Tests\Browser\Pages;

use Illuminate\Support\Facades\Log;
use Laravel\Dusk\Browser;

/**
 * Class LoginPage
 * @package Tests\Browser\Pages
 */
class RegisterPage extends Page
{
    const REGISTER_URL = '/register';
    const USER_NAME = 'harish patel';
    const USER_EMAIL = 'harish.patel@multidots.com';
    const USER_PASS = '123456';
    const WRONG_USER_ = 'hrspatel@gmail.com';
    const WRONG_USER_EMAIL = 'hrspatel@gmail.com';
    const WRONG_USER_PASS = '123456';
    const HOME_URL = '/home';
    const HOME_ASSERT_STRING_1 = 'Dashboard';
    const HOME_ASSERT_STRING_2 = 'You are logged in!';
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/';
    }

    /**
     * grt home url
     * @return string
     */
    public static function homeUrl()
    {
        $appUrl = config('app.url');
        return $appUrl . self::HOME_URL;
    }


    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        //
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }

    /**
     * asserting Full Form Validation
     * @param Browser $browser
     */
    public static function assertFullFormValidation(Browser $browser)
    {
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
    }

    /**
     * assert password validation
     * @param Browser $browser
     */
    public static function assertPasswordValidation(Browser $browser)
    {

        $browser->visit(RegisterPage::REGISTER_URL);
        Log::info('[testRegisterUserFormValidation]: Visited registration page.');

        $browser->type('email', RegisterPage::USER_EMAIL);
        Log::info('[testRegisterUserFormValidation]: Enter email to check other field validations.');

        $browser->press('Register');
        Log::info('[testRegisterUserFormValidation]: Hit register button to authenticate.');

        $browser->pause(200);
        $browser->assertSee('The password field is required.')->pause(200);
        Log::info('[testRegisterUserFormValidation]: Register form validation assertions seems fine.');
    }

    /**
     * assert name validation
     * @param Browser $browser
     */
    public static function assertNameValidation(Browser $browser)
    {
        $browser->visit(RegisterPage::REGISTER_URL);
        Log::info('[testRegisterUserFormValidation]: Visited registration page.');

        $browser->type('email', RegisterPage::USER_EMAIL);
        $browser->press('Register');
        Log::info('[testRegisterUserFormValidation]: Hit register button to authenticate.');

        $browser->pause(200);
        $browser->assertSee('The name field is required.')->pause(200);
        Log::info('[testRegisterUserFormValidation]: Register form validation assertions seems fine.');
    }

    /**
     * assert email validation
     * @param Browser $browser
     */
    public static function assertEmailValidation(Browser $browser)
    {
        $browser->visit(RegisterPage::REGISTER_URL);
        Log::info('[testRegisterUserFormValidation]: Visited registration page.');

        $browser->type('password', RegisterPage::USER_PASS);
        $browser->press('Register');
        Log::info('[testRegisterUserFormValidation]: Hit register button to authenticate.');

        $browser->pause(200);
        $browser->assertSee('The email field is required.')->pause(200);
        Log::info('[testRegisterUserFormValidation]: Register form validation assertions seems fine.');
    }

    /**
     * assert registration
     * @param Browser $browser
     * @throws \Facebook\WebDriver\Exception\TimeOutException
     */
    public static function assertRegister(Browser $browser)
    {
        $browser->visit(RegisterPage::REGISTER_URL);
        Log::info('[testRegister]: Visited registration page.');

        $browser->type('name', RegisterPage::USER_NAME. rand(1,100));
        $browser->type('email', RegisterPage::USER_EMAIL. rand(1,100));
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

    }
}
