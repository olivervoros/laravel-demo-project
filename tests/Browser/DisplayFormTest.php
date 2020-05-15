<?php

namespace Tests\Browser;

use Facebook\WebDriver\WebDriverBy;
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

    public function there_is_only_one_CSRF_input_field_in_the_source_code()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/formtest');
            $elements = $browser->driver->findElements(WebDriverBy::name('_token'));
            $this->assertCount(1, $elements);
        });
    }

    /** @test */
    public function the_CSRF_field_is_not_visible()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/formtest')
                ->assertMissing('_token');
        });
    }

    public function form_does_not_have_an_age_field()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/formtest')
                ->assertSourceMissing('age');
        });
    }

    /** @test */
    public function form_has_exactly_four_input_fields()
    {
        $this->browse(function ($browser) {
            $browser->visit('/formtest');
            $elements = $browser->driver->findElements(WebDriverBy::tagName('input'));
            $this->assertCount(4, $elements);
        });
    }

    /** @test */
    public function form_has_exactly_one_submit_button_with_the_given_html_code()
    {
        $this->browse(function ($browser) {
            $browser->visit('/formtest');
            $elements = $browser->driver->findElements(WebDriverBy::tagName('button'));
            $this->assertCount(1, $elements);
            $browser->assertSourceHas('<button id="submitForm" type="submit" class="btn btn-primary">Register</button>');
        });
    }

    /** @test */
    public function form_has_the_fullname_the_email_and_the_password_input_fields()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/formtest')
                ->assertSourceHas('name="fullname"')
                ->assertSourceHas('name="email"')
                ->assertSourceHas('name="password"');
        });
    }


}
