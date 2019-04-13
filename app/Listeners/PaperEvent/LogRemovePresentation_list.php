<?php

namespace App\Listeners\PaperEvent;

use App\Events\PaperEvent\RemovePresentationList;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogRemovePresentation_list
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
     * @param  RemovePresentation_list  $event
     * @return void
     */
    public function handle(RemovePresentationList $event)
    {
        //
    }
}
