<?php

namespace App\Listeners\PaperEvent;

use App\Events\PaperEvent\PaperSubmitted;
use App\Models\PaperEventLog;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class LogPaperSubmitted
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
     * @param  PaperSubmitted  $event
     * @return void
     */
    public function handle(PaperSubmitted $event)
    {
        $paperEventLog = new PaperEventLog();
        $paperEventLog->paper_id = $event->paper->id;
        $paperEventLog->user_id = Auth::id();
        $paperEventLog->type = Config::get('constants.PAPER_EVENT.SUBMITTED');
        $paperEventLog->message = sprintf(Config::get('constants.PAPER_EVENT.SUBMITTED_MESSAGE'), Auth::user()->full_name, $event->paper->title, Carbon::now()->format('H:i d/m/Y'));
        $paperEventLog->save();
    }
}
