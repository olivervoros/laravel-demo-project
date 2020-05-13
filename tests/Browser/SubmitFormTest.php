<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\App;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SubmitFormTest extends DuskTestCase
{

    /** @test */
    public function submitting_the_form_empty_results_three_error_messages()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/formtest')
                ->type('fullname', '')
                ->type('email', '')
                ->type('password', '')
                ->click('button#submitForm')
                ->assertSee("The fullname field is required.")
                ->assertSee("The email field is required.")
                ->assertSee("The password field is required.");
        });
    }

    /** @test */
    public function form_shows_an_error_message_when_no_fullname_inserted()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/formtest')
                ->type('fullname', '')
                ->type('email', 'oliver')
                ->type('password', 'password')
                ->click('button#submitForm')
                ->assertSee("The fullname field is required.");
        });
    }

    /** @test */
    public function form_shows_an_error_message_when_invalid_email_inserted()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/formtest')
                ->type('fullname', 'Oliver Test')
                ->type('email', 'oliver')
                ->type('password', 'password')
                ->click('button#submitForm')
                ->assertSee("The email must be a valid email address.");
        });
    }

    /** @test */
    public function form_shows_an_error_message_when_too_short_password_inserted()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/formtest')
                ->type('fullname', 'Oliver Test')
                ->type('email', 'oliver@test.com')
                ->type('password', '123456')
                ->click('button#submitForm')
                ->assertSee("The password must be at least 8 characters.");
        });
    }

    /** @test */
    public function form_submission_works_with_valid_data()
    {
        $dashboardUrl = App::make('url')->to('/dashboard');
        $this->browse(function (Browser $browser) use ($dashboardUrl) {
            $browser->visit('/formtest')
                ->type('fullname', 'Oliver Test')
                ->type('email', 'oliver@test.com')
                ->type('password', 'newpassword')
                ->click('button#submitForm')
                ->assertUrlIs($dashboardUrl)
                ->assertSee("Welcome to the dashboard!");
        });
    }
}
