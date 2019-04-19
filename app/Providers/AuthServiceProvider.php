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
        Gate::before(function ($user, $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });
        $this->registerPaperPolicies();
        $this->registerTrackPolicies();
        $this->registerSessionTypePolicies();
    }

    public function registerPaperPolicies()
    {
        Gate::define('send-paper', 'App\Policies\PaperPolicies@sendPaper');
        Gate::define('update-paper', 'App\Policies\PaperPolicies@update');
    }

    public function registerTrackPolicies()
    {
        Gate::define('view-track', 'App\Policies\TrackPolicies@view');
        Gate::define('create-track', 'App\Policies\TrackPolicies@create');
        Gate::define('update-track', 'App\Policies\TrackPolicies@update');
        Gate::define('delete-track', 'App\Policies\TrackPolicies@delete');
    }

    public function registerSessionTypePolicies()
    {
        Gate::define('view-session-type', 'App\Policies\SessionTypePolicies@view');
        Gate::define('create-session-type', 'App\Policies\SessionTypePolicies@create');
        Gate::define('update-session-type', 'App\Policies\SessionTypePolicies@update');
        Gate::define('delete-session-type', 'App\Policies\SessionTypePolicies@delete');
    }

}
