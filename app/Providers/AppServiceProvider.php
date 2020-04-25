<?php

namespace App\Providers;

use App\FlightInfoEventGenerator;
use App\Mixins\StringMixins;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function boot()
    {
        $this->app->singleton('FlightInfoEventGeneratorService', function($app) {
            return new FlightInfoEventGenerator();
        });

        $user = factory(User::class)->make();
        Auth::login($user);

        Str::mixin(new StringMixins());
    }
}
