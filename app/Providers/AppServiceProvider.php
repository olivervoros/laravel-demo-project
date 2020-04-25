<?php

namespace App\Providers;

use App\FlightInfoEventGenerator;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
     */
    public function boot()
    {
        $this->app->singleton('FlightinfoEventGeneratorService', function($app) {
            return new FlightInfoEventGenerator();
        });

        $user = factory(User::class)->make();
        Auth::login($user);
    }
}
