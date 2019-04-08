<?php

namespace App\Listeners\PaperEvent;

use App\Events\PaperEvent\AssignReviewer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;

class PaperChangeStatusWhenAssignReviewer
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
     * @param  AssignReviewer  $event
     * @return void
     */
    public function handle(AssignReviewer $event)
    {
        //Change paper status
        $paper =  $event->reviewAssignment->paper;
        if(($paper->status == Config::get('constants.PAPER_STATUS.SUBMITTED')) || ($paper->status == Config::get('constants.PAPER_STATUS.ALL_REVIEWER_RECOMMENDATION'))){
            $paper->status = Config::get('constants.PAPER_STATUS.IN_REVIEW');
            $paper->save();
        }
    }
}
