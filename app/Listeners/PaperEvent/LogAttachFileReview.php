<?php

namespace App\Listeners\PaperEvent;

use App\Events\PaperEvent\AttachFileReview;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use App\Models\PaperEventLog;
use Carbon\Carbon;

class LogAttachFileReview
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
     * @param  AttachFileReview  $event
     * @return void
     */
    public function handle(AttachFileReview $event)
    {
        $paperEventLog = new PaperEventLog();
        $paperEventLog->paper_id = $event->reviewAssignment->paper->id;
        $paperEventLog->user_id = Auth::id();
        $paperEventLog->type = Config::get('constants.PAPER_EVENT.ATTACH_FILE_REVIEW');
        $paperEventLog->message = sprintf(Config::get('constants.PAPER_EVENT.ATTACH_FILE_REVIEW_MESAGE'), Auth::user()->full_name, $event->reviewAssignment->paper->title, Carbon::now()->format('H:i d/m/Y'));
        $paperEventLog->save();
    }
}
