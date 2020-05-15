<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class FormPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/formtest';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertSee('Welcome to our Website!')
                ->assertSee('Please register below')
                ->assertSee('Full Name')
                ->assertSee('Email address')
                ->assertSee('We will never share your email with anyone else.')
                ->assertSee('Password');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@token' => 'input[name=_token]',
        ];
    }
}
