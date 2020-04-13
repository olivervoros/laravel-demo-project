<?php

namespace App\Providers;

use App\Article;
use App\Http\View\Composers\ArticlesComposer;
use Illuminate\Support\Facades\View;
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

        // 1, This has to be used with caution, as the SQL query will load every single time we load a view
        //View::share('articles', Article::orderby('title', 'asc')->get());

        // 2, We only share the data with the chosen views
        /*
        View::composer(['article.index', 'review.create'], function($view) {

            $view->with('articles', Article::orderby('title', 'asc')->get());
        });
        */

        // 3, Chosen views with wildcards
        /*
        View::composer(['article.*', 'review.create'], function($view) {

            $view->with('articles', Article::orderby('title', 'asc')->get());
        });
        */

        // 4, create a  view composer class - good for data heavy composers
        //View::composer(['article.index', 'review.create', 'cms.create'],ArticlesComposer::class);

        // 5, refactored all article views to partials
        View::composer(['partials.articles.*'],ArticlesComposer::class);

    }
}
