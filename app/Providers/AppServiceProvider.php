<?php

namespace App\Providers;

use App\Mixins\CollectionMixins;
use Illuminate\Database\Eloquent\Collection;
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

        Collection::mixin(new CollectionMixins());

        Str::macro('evenCharacterUpperCase', function($string) {
            $output = '';
            $stringToLoop = str_split($string);
            foreach($stringToLoop as $key => $value)
            {
                // Array starts with zero index...
                if($key%2 !== 0)  {
                    $output .= strtoupper($value);
                } else {
                    $output .= $value;
                }
            }
            return $output;
        });
    }
}
