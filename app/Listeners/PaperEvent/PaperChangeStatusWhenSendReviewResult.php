<?php

namespace App\Listeners\PaperEvent;

use App\Events\PaperEvent\SendReviewResult;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;

class PaperChangeStatusWhenSendReviewResult
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
     * @param  SendReviewResult  $event
     * @return void
     */
    public function handle(SendReviewResult $event)
    {
        $paper =  $event->reviewAssignment->paper;
        if($paper->status == Config::get('constants.PAPER_STATUS.IN_REVIEW')){
            $recommendations = $paper->reviewAssignment->pluck('reviewAssignment')->all();
            $test = TRUE;
            foreach ($recommendations as $recommendation) {
                if(empty($recommendation)){
                    $test = FALSE;
                    break;
                }
            }
            if($test){
                $paper->status = Config::get('constants.PAPER_STATUS.ALL_REVIEWER_RECOMMENDATION');
                $paper->save();
            }
        }
    }
}
