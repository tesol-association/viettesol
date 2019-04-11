<?php

namespace App\Listeners\PaperEvent;

use App\ConferenceRepositories\PaperRepository;
use App\Events\PaperEvent\TrackDecided;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;

class PaperChangeStatusWhenLogTrackDecided
{
    protected $paperRepository;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PaperRepository $paperRepository)
    {
        $this->paperRepository = $paperRepository;
    }

    /**
     * Handle the event.
     *
     * @param  TrackDecided  $event
     * @return void
     */
    public function handle(TrackDecided $event)
    {
        $paper = $event->decision->paper;

        switch ($event->decision->decision) {
            case Config::get('constants.PAPER.ACCEPTED'):
                $status = Config::get('constants.PAPER_STATUS.ACCEPTED');
                break;
            case Config::get('constants.PAPER.REVISION'):
                $status = Config::get('constants.PAPER_STATUS.REVISION');
                break;
            case Config::get('constants.PAPER.REJECTED'):
                $status = Config::get('constants.PAPER_STATUS.REJECTED');
                break;
        }
        if (isset($status)) {
            $this->paperRepository->changePaperStatus($paper, $status);
        }
    }

}
