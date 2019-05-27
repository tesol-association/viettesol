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
        $this->registerConferenceTimelinePolicies();
        $this->registerAnnouncementPolicies();
        $this->registerPaperFilePolicies();
        $this->registerConferenceGalleryPolicies();
        $this->registerReviewFormPolicies();
        $this->registerPaperPolicies();
        $this->registerTrackPolicies();
        $this->registerSessionTypePolicies();
    }

    public function registerConferenceTimelinePolicies()
    {
        Gate::define('view-conference-timeline', 'App\Policies\ConferenceTimelinePolicies@view');
    }

    public function registerAnnouncementPolicies()
    {
        Gate::define('view-announcement', 'App\Policies\AnnouncementPolicies@view');
        Gate::define('create-announcement', 'App\Policies\AnnouncementPolicies@create');
        Gate::define('update-announcement', 'App\Policies\AnnouncementPolicies@update');
        Gate::define('delete-announcement', 'App\Policies\AnnouncementPolicies@delete');
    }

    public function registerPaperFilePolicies()
    {
        Gate::define('view-paper-file', 'App\Policies\PaperFilePolicies@view');
    }

    public function registerConferenceGalleryPolicies()
    {
        Gate::define('view-conference-gallery', 'App\Policies\ConferenceGalleryPolicies@view');
        Gate::define('create-conference-gallery', 'App\Policies\ConferenceGalleryPolicies@create');
        Gate::define('delete-conference-gallery', 'App\Policies\ConferenceGalleryPolicies@delete');
    }

    public function registerReviewFormPolicies()
    {
        Gate::define('view-review-form', 'App\Policies\ReviewFormPolicies@view');
        Gate::define('create-review-form', 'App\Policies\ReviewFormPolicies@create');
        Gate::define('update-review-form', 'App\Policies\ReviewFormPolicies@update');
        Gate::define('delete-review-form', 'App\Policies\ReviewFormPolicies@delete');
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
