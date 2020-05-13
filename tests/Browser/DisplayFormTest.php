<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DisplayFormTest extends DuskTestCase
{

    /** @test */
    public function form_has_correct_header_text()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/formtest')
                    ->assertSee('Welcome to our Website!');
        });
    }

    /** @test */
    public function form_has_a_hidden_CSRF_field()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/formtest')
                    ->assertSourceHas('name="_token"');
        });
    }

    /** @test */
    public function form_email_validation_works()
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
    public function form_password_length_validation_works()
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
}
