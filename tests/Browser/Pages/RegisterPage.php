<?php

namespace Tests\Browser\Pages;

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
}
