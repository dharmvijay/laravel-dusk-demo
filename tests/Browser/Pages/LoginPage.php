<?php

namespace Tests\Browser\Pages;

use Illuminate\Support\Facades\Log;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class LoginPage
 * @package Tests\Browser\Pages
 */
class LoginPage extends Page
{
    const LOGIN_URL = '/login';
    const USER_EMAIL = 'dharmvijay.patel@gmail.com';
    const USER_PASS = '123456';
    const WRONG_USER_EMAIL = 'dvpatel@gmail.com';
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
     * assert logout method
     * @param Browser $browser
     * @throws \Facebook\WebDriver\Exception\TimeOutException
     */
    public static function assertLogout(Browser $browser)
    {
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

    }

    /**
     * assert full login form
     * @param Browser $browser
     */
    public static function assertFullFormValidation(Browser $browser)
    {
        $browser->visit(LoginPage::LOGIN_URL);
        Log::info('[testLoginFormValidation]: visited login page');

        $browser->press('Login');
        Log::info('[testLoginFormValidation]: Hit login button without entering any value to test client side validations.');

        $browser->pause(200);
        $browser->assertSee('The email field is required.');
        $browser->assertSee('The password field is required.')->pause(200);
        Log::info('[testLoginFormValidation]: Validation message assertions seems fine.');
        Log::info('[testLoginFormValidation]: Field Validations executed successfully.');
    }

    /**
     * assert password validation
     * @param Browser $browser
     */
    public static function assertPassValidation(Browser $browser)
    {
        $browser->visit(LoginPage::LOGIN_URL);
        Log::info('[testLoginFormValidation]: Visited login page');

        $browser->type('email', LoginPage::USER_EMAIL);
        Log::info('[testLoginFormValidation]: Entered in email address field and password kept blank.');

        $browser->press('Login');
        Log::info('[testLoginFormValidation]: Hit login button to check password required validation.');

        $browser->pause(200);
        $browser->assertSee('The password field is required.')->pause(200);
        Log::info('[testLoginFormValidation]: Validation message assertions seems fine.');
        Log::info('[testLoginFormValidation]: Password Field validation test executed successfully.');

    }

    /**
     * assert email validation
     * @param Browser $browser
     */
    public static function assertEmailValidation(Browser $browser)
    {
        $browser->visit(LoginPage::LOGIN_URL);
        Log::info('[testLoginFormValidation]: Visited login page');

        $browser->type('password', LoginPage::USER_PASS);
        Log::info('[testLoginFormValidation]: Entered in password field and email field kept blank.');

        $browser->press('Login');
        Log::info('[testLoginFormValidation]: Hit login button to check email required validation.');

        $browser->pause(200);
        $browser->assertSee('The email field is required.')->pause(200);
        Log::info('[testLoginFormValidation]: Validation message assertions seems fine.');
        Log::info('[testLoginFormValidation]: Email Field validation test executed successfully.');
    }

    /**
     * assert invalid data
     * @param Browser $browser
     */
    public static function assertInValidDataValidation(Browser $browser)
    {
        $browser->visit(LoginPage::LOGIN_URL);
        Log::info('[testLoginFormValidation]: Visited login page');

        $browser->type('email', LoginPage::WRONG_USER_EMAIL);
        $browser->type('password', LoginPage::WRONG_USER_PASS);
        Log::info('[testLoginFormValidation]: Entered wrong values in email and password field');

        $browser->press('Login');
        Log::info('[testLoginFormValidation]: Hit login button to authenticate.');

        $browser->pause(200);
        $browser->assertSee('These credentials do not match our records.')->pause(200);
        Log::info('[testLoginFormValidation]: Validation message assertions seems fine.');
        Log::info('[testLoginFormValidation]: Enter wrong values validation test executed successfully.');

    }

    /**
     * assert login
     * @param Browser $browser
     * @throws \Facebook\WebDriver\Exception\TimeOutException
     */
    public static function assertLogin(Browser $browser)
    {
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
        Log::info('[testLogin]: Login assertions seems fine.');
        Log::info('[testLogin]: Enter wrong values validation test executed successfully.');
    }


}
