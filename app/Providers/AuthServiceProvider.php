<?php

namespace App\Providers;

use App\Article;
use App\Policies\ArticlePolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-admin-dashboard', function ($user) {
            return $user->isAdmin()
                ? Response::allow()
                : Response::deny('You must be an Administrator to view the dashboard, and your role is: '.$user->role->role);
        });

        Gate::define('view-article', function ($user, $article) {
            return ($user->id === $article->user_id)
                ? Response::allow()
                : Response::deny('You are only allowed to view your own articles... - (see AuthServiceProvider Gate)');
        });
    }
}
