<?php

namespace App\Providers;

use App\Events\PaperSubmitted;
use App\Listeners\SendSubmissionNotification;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PaperSubmitted::class => [
            SendSubmissionNotification::class,
        ],
        'App\Events\PaperEvent\PaperEditSubmissioned' => [
            'App\Listeners\PaperEvent\PaperLogEditSubmissioned',
        ],
        'App\Events\PaperEvent\AddCoAuthor' => [
            'App\Listeners\PaperEvent\LogAddCoAuthor',
        ],
        'App\Events\PaperEvent\SendFullPaper' => [
            'App\Listeners\PaperEvent\LogSendFullPaper',
        ],
        'App\Events\PaperEvent\AssignReviewer' => [
            'App\Listeners\PaperEvent\LogAssignReviewer',
            'App\Listeners\PaperEvent\PaperChangeStatusWhenAssignReviewer',
        ],
        'App\Events\PaperEvent\Unassigned' => [
            'App\Listeners\PaperEvent\LogUnassigned',
        ],
        'App\Events\PaperEvent\TrackDecided' => [
            'App\Listeners\PaperEvent\LogTrackDecided',
            'App\Listeners\PaperEvent\PaperChangeStatusWhenLogTrackDecided',
        ],
        'App\Events\PaperEvent\SendReviewResult' => [
            'App\Listeners\PaperEvent\LogSendReviewResult',
            'App\Listeners\PaperEvent\PaperChangeStatusWhenSendReviewResult',
        ],
        'App\Events\PaperEvent\AttachFileReview' => [
            'App\Listeners\PaperEvent\LogAttachFileReview',
        ],
        'App\Events\PaperEvent\AddPresentationList' => [
            'App\Listeners\PaperEvent\LogAddPresentationList',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
