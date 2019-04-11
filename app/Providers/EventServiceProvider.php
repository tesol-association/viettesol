<?php

namespace App\Providers;

use App\Events\PaperEvent\AddCoAuthor;
use App\Events\PaperEvent\AssignReviewer;
use App\Events\PaperEvent\PaperEditSubmissioned;
use App\Events\PaperEvent\SendFullPaper;
use App\Events\PaperEvent\SendReviewResult;
use App\Events\PaperSubmitted;
use App\Listeners\PaperEvent\LogAddCoAuthor;
use App\Listeners\PaperEvent\LogAssignReviewer;
use App\Listeners\PaperEvent\LogSendFullPaper;
use App\Listeners\PaperEvent\LogSendReviewResult;
use App\Listeners\PaperEvent\PaperChangeStatusWhenAssignReviewer;
use App\Listeners\PaperEvent\PaperChangeStatusWhenSendReviewResult;
use App\Listeners\PaperEvent\PaperLogEditSubmissioned;
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
        PaperEditSubmissioned::class => [
            PaperLogEditSubmissioned::class,
        ],
        AddCoAuthor::class => [
            LogAddCoAuthor::class,
        ],
        SendFullPaper::class => [
            LogSendFullPaper::class,
        ],
        AssignReviewer::class => [
            LogAssignReviewer::class,
            PaperChangeStatusWhenAssignReviewer::class,
        ],
        SendReviewResult::class => [
            LogSendReviewResult::class,
            PaperChangeStatusWhenSendReviewResult::class,
        ],
        'App\Events\PaperEvent\TrackDecided' => [
            'App\Listeners\PaperEvent\LogTrackDecided',
            'App\Listeners\PaperEvent\PaperChangeStatusWhenLogTrackDecided',
        ],
        'App\Events\PaperEvent\Unassigned' => [
            'App\Listeners\PaperEvent\LogUnassigned',
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
