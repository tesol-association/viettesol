<?php

namespace App\Listeners\PaperEvent;

use App\Events\PaperEvent\TrackDecided;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;

class PaperChangeStatusWhenLogTrackDecided
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if(in_array($paper->status, [Config::get('constants.PAPER_STATUS.SUBMITTED'), Config::get('constants.PAPER_STATUS.IN_REVIEW'), Config::get('constants.PAPER_STATUS.ALL_REVIEWER_RECOMMENDATION')])){
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
                default:
                    $status = '';
                    break;
            }

            $paper->status = $status;
            $paper->save();
        }
    }
}
