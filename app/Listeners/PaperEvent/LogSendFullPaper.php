<?php

namespace App\Listeners\PaperEvent;

use App\Events\PaperEvent\SendFullPaper;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use App\Models\PaperEventLog;
use Carbon\Carbon;

class LogSendFullPaper
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
     * @param  SendFullPaper  $event
     * @return void
     */
    public function handle(SendFullPaper $event)
    {
        $paperEventLog = new PaperEventLog();
        $paperEventLog->paper_id = $event->paper->id;
        $paperEventLog->user_id = Auth::id();
        $paperEventLog->type = Config::get('constants.PAPER_EVENT.SEND_FULL_PAPER');
        $paperEventLog->message = sprintf(Config::get('constants.PAPER_EVENT.SEND_FULL_PAPE_MESSAGE'), Auth::user()->full_name, $event->paper->title, Carbon::now()->format('H:i d/m/Y'));
        $paperEventLog->save();
    }
}
