<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\App;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomepageTest extends DuskTestCase
{
    /** @test */
    public function the_homepage_has_the_right_header_and_links()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Hello World!')
                    ->assertSee('Go to the registration form')
                    ->assertSee('Go to dashboard');
        });
    }

    /** @test */
    public function clicking_on_the_go_to_dashboard_link_redirects_to_the_dashboard()
    {
        $dashboardUrl = App::make('url')->to('/dashboard');
        $this->browse(function (Browser $browser) use ($dashboardUrl) {
            $browser->visit('/')
                    ->clickLink('Go to dashboard')
                    ->assertUrlIs($dashboardUrl)
                    ->assertSee("Welcome to the dashboard!");

        });
    }

    /** @test */
    public function clicking_on_the_go_to_registration_form_link_redirects_to_the_registration_form()
    {
        $registrationFormUrl = App::make('url')->to('/formtest');
        $this->browse(function (Browser $browser) use ($registrationFormUrl) {
            $browser->visit('/')
                ->clickLink('Go to the registration form')
                ->assertUrlIs($registrationFormUrl)
                ->assertSee("Welcome to our Website!");

        });
    }

    /** @test */
    public function clicking_on_blue_button_opens_the_popup_and_displays_the_default_name()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('#openPrompt')
                ->assertDialogOpened("Please enter your name:")
                ->acceptDialog()
                ->assertSee('Stranger');
        });
    }

    /** @test */
    public function clicking_on_blue_button_opens_the_popup_and_after_that_it_displays_entered_name()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('#openPrompt')
                ->assertDialogOpened("Please enter your name:")
                ->typeInDialog('Paul Denton')
                ->acceptDialog()
                ->assertSee('Paul Denton');
        });
    }

    /** @test */
    public function clicking_on_blue_button_opens_the_popup_and_clicking_one_cancel_shows_an_error_message()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->click('#openPrompt')
                ->assertDialogOpened("Please enter your name:")
                ->dismissDialog()
                ->assertSee('User cancelled the prompt');
        });
    }

}
