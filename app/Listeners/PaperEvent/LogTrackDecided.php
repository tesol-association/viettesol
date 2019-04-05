<?php

namespace App\Listeners\PaperEvent;

use App\Events\PaperEvent\TrackDecided;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use App\Models\PaperEventLog;
use Carbon\Carbon;

class LogTrackDecided
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
        $paperEventLog = new PaperEventLog();
        $paperEventLog->paper_id = $event->decision->paper_id;
        $paperEventLog->user_id = Auth::id();
        $paperEventLog->type = Config::get('constants.PAPER_EVENT.TRACK_DICIDED');
        switch ($event->decision->decision) {
            case Config::get('constants.PAPER.ACCEPTED'):
                $decisionMessage = 'accepted';
                break;
            case Config::get('constants.PAPER.REVISION'):
                $decisionMessage = 'revision';
                break;
            case Config::get('constants.PAPER.REJECTED'):
                $decisionMessage = 'rejected';
                break;

            default:
                $decisionMessage = '';
                break;
        }
        $paperEventLog->message = sprintf(Config::get('constants.PAPER_EVENT.TRACK_DICIDED_MESSAGE'), Auth::user()->full_name, $decisionMessage, $event->decision->paper->title, Carbon::now()->format('H:i d/m/Y'));
        $paperEventLog->save();
    }
}
