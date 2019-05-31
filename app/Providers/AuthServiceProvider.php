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
        $this->registerTimeBlockPolicies();
        $this->registerSpeakerPolicies();
        $this->registerFeePolicies();
        $this->registerConferencePartnerSponserPolicies();
        $this->registerPrePairEmailPolicies();
        $this->registerPaperAuthorPolicies();
        $this->registerSchedulePolicies();
        $this->registerBuildingPolicies();
        $this->registerRoomPolicies();
        $this->registerSpecialEventPolicies();
        $this->registerCalendarPolicies();
        $this->registerConferenceRolePolicies();
        $this->registerUserConferenceRolePolicies();
        $this->registerConferencePermissionPolicies();
        $this->registerRegisterConferencePolicies();
        $this->registerReviewerCriteriaPolicies();
        $this->registerReviewerPolicies();
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
        Gate::define('view-paper', 'App\Policies\PaperPolicies@view');
        Gate::define('send-paper', 'App\Policies\PaperPolicies@sendPaper');
        Gate::define('update-paper', 'App\Policies\PaperPolicies@update');
        Gate::define('view-paper-un-schedule', 'App\Policies\PaperPolicies@viewPaperUnSchedule');
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

    public function registerTimeBlockPolicies()
    {
        Gate::define('view-time-block', 'App\Policies\TimeBlockPolicies@view');
        Gate::define('create-time-block', 'App\Policies\TimeBlockPolicies@create');
        Gate::define('update-time-block', 'App\Policies\TimeBlockPolicies@update');
        Gate::define('delete-time-block', 'App\Policies\TimeBlockPolicies@delete');
    }

    public function registerSpeakerPolicies()
    {
        Gate::define('view-speaker', 'App\Policies\SpeakerPolicies@view');
        Gate::define('create-speaker', 'App\Policies\SpeakerPolicies@create');
        Gate::define('update-speaker', 'App\Policies\SpeakerPolicies@update');
        Gate::define('delete-speaker', 'App\Policies\SpeakerPolicies@delete');
    }

    public function registerFeePolicies()
    {
        Gate::define('view-fee', 'App\Policies\FeePolicies@view');
        Gate::define('create-fee', 'App\Policies\FeePolicies@create');
        Gate::define('update-fee', 'App\Policies\FeePolicies@update');
        Gate::define('delete-fee', 'App\Policies\FeePolicies@delete');
    }

    public function registerConferencePartnerSponserPolicies()
    {
        Gate::define('view-conference-partner-sponser', 'App\Policies\ConferencePartnerSponserPolicies@view');
        Gate::define('create-conference-partner-sponser', 'App\Policies\ConferencePartnerSponserPolicies@create');
        Gate::define('update-conference-partner-sponser', 'App\Policies\ConferencePartnerSponserPolicies@update');
        Gate::define('delete-conference-partner-sponser', 'App\Policies\ConferencePartnerSponserPolicies@delete');
    }

    public function registerPrePairEmailPolicies()
    {
        Gate::define('view-prepair-email', 'App\Policies\PrePairEmailPolicies@view');
        Gate::define('send-prepair-email', 'App\Policies\PrePairEmailPolicies@send');
    }

    public function registerPaperAuthorPolicies()
    {
        Gate::define('view-paper-author', 'App\Policies\PaperAuthorPolicies@view');
    }

    public function registerSchedulePolicies()
    {
        Gate::define('view-schedule', 'App\Policies\SchedulePolicies@view');
        Gate::define('create-schedule', 'App\Policies\SchedulePolicies@create');
        Gate::define('delete-schedule', 'App\Policies\SchedulePolicies@delete');
    }

    public function registerBuildingPolicies()
    {
        Gate::define('view-building', 'App\Policies\BuildingPolicies@view');
        Gate::define('create-building', 'App\Policies\BuildingPolicies@create');
        Gate::define('update-building', 'App\Policies\BuildingPolicies@update');
        Gate::define('delete-building', 'App\Policies\BuildingPolicies@delete');
    }

    public function registerRoomPolicies()
    {
        Gate::define('view-room', 'App\Policies\RoomPolicies@view');
        Gate::define('create-room', 'App\Policies\RoomPolicies@create');
        Gate::define('update-room', 'App\Policies\RoomPolicies@update');
        Gate::define('delete-room', 'App\Policies\RoomPolicies@delete');
    }

    public function registerSpecialEventPolicies()
    {
        Gate::define('view-special-event', 'App\Policies\SpecialEventPolicies@view');
        Gate::define('create-special-event', 'App\Policies\SpecialEventPolicies@create');
        Gate::define('update-special-event', 'App\Policies\SpecialEventPolicies@update');
        Gate::define('delete-special-event', 'App\Policies\SpecialEventPolicies@delete');
    }

    public function registerCalendarPolicies()
    {
        Gate::define('view-calendar-for-paper', 'App\Policies\CalendarPolicies@viewForPaper');
        Gate::define('view-calendar-for-conference', 'App\Policies\CalendarPolicies@viewForConference');
    }

    public function registerConferenceRolePolicies()
    {
        Gate::define('view-conference-role', 'App\Policies\ConferenceRolePolicies@view');
        Gate::define('create-conference-role', 'App\Policies\ConferenceRolePolicies@create');
        Gate::define('update-conference-role', 'App\Policies\ConferenceRolePolicies@update');
        Gate::define('delete-conference-role', 'App\Policies\ConferenceRolePolicies@delete');
    }

    public function registerUserConferenceRolePolicies()
    {
        Gate::define('view-user-conference-role', 'App\Policies\UserConferenceRolePolicies@view');
        Gate::define('update-user-conference-role', 'App\Policies\UserConferenceRolePolicies@update');
    }

    public function registerConferencePermissionPolicies()
    {
        Gate::define('view-conference-permission', 'App\Policies\ConferencePermissionPolicies@view');
        Gate::define('create-conference-permission', 'App\Policies\ConferencePermissionPolicies@create');
        Gate::define('update-conference-permission', 'App\Policies\ConferencePermissionPolicies@update');
        Gate::define('view-set-up-conference-permission', 'App\Policies\ConferencePermissionPolicies@viewSetUp');
        Gate::define('set-up-conference-permission', 'App\Policies\ConferencePermissionPolicies@setUp');
    }

    public function registerRegisterConferencePolicies()
    {
        Gate::define('view-register-conference', 'App\Policies\RegisterConferencePolicies@view');
        Gate::define('create-register-conference', 'App\Policies\ConferenceRolePolicies@create');
        Gate::define('update-register-conference', 'App\Policies\ConferenceRolePolicies@update');
    }

    public function registerReviewerCriteriaPolicies()
    {
        Gate::define('view-reviewer-criterial', 'App\Policies\ReviewerCriteriaPolicies@view');
    }

    public function registerReviewerPolicies()
    {
        Gate::define('view-reviewer', 'App\Policies\ReviewerPolicies@view');
    }
}
