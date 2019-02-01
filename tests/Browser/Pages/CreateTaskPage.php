<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class CreateTaskPage extends Page
{
    const STORE_API_URI = '/api/store-task';
    const LIST_TASK = '/list-task';
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/create-task';
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
