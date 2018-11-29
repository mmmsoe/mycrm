<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('assign', function ($user) {
            if($user->role > 0) return true;
            return false;
        });

        Gate::define('comment-delete', function ($user, $comment) {
            if($user->id == $comment->user_id or
                $user->role > 0) return true;
                
            return false;
        });
    }
}
