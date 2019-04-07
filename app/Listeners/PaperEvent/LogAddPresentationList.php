<?php

namespace App\Listeners\PaperEvent;

use App\Events\PaperEvent\AddPresentationList;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogAddPresentationList
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
     * @param  AddPresentationList  $event
     * @return void
     */
    public function handle(AddPresentationList $event)
    {
        //
    }
}
