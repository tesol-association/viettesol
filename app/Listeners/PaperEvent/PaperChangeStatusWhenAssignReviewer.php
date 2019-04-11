<?php

namespace App\Listeners\PaperEvent;

use App\ConferenceRepositories\PaperRepository;
use App\Events\PaperEvent\AssignReviewer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;

class PaperChangeStatusWhenAssignReviewer
{
    protected $papers;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PaperRepository $paperRepository)
    {
        $this->papers = $paperRepository;
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
        $this->papers->changePaperStatus($paper, Config::get('constants.PAPER_STATUS.IN_REVIEW'));
    }
}
