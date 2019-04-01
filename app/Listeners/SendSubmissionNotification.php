<?php

namespace App\Listeners;

use App\Events\PaperSubmitted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendSubmissionNotification
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

    }
}
