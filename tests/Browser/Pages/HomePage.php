<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class HomePage extends Page
{
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
     * Assert that the browser is on the page.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertSee('Hello World!')
                ->assertSee('Go to the registration form')
                ->assertSee('Go to dashboard');
    }

    public function assertPopupWorks(Browser $browser)
    {

        $browser->assertDialogOpened("Please enter your name:")
                ->acceptDialog()
                ->assertSee('Stranger');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@openPopupButton' => '#openPrompt',
        ];
    }
}
