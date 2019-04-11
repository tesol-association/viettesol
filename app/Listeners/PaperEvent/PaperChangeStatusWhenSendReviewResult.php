<?php

namespace App\Listeners\PaperEvent;

use App\ConferenceRepositories\PaperRepository;
use App\ConferenceRepositories\ReviewAssignmentRepository;
use App\Events\PaperEvent\SendReviewResult;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;

class PaperChangeStatusWhenSendReviewResult
{
    protected $reviewAssignmentRepository;
    protected $paperRepository;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ReviewAssignmentRepository $reviewAssignmentRepository, PaperRepository $paperRepository)
    {
        $this->reviewAssignmentRepository = $reviewAssignmentRepository;
        $this->paperRepository = $paperRepository;
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
        $dateCompleteReviewAssignents = $this->reviewAssignmentRepository->get(['paper_id' => $paper->id])->pluck('date_completed')->all();
        // All date completed has value
        if (!in_array(null, $dateCompleteReviewAssignents, true)) {
            $this->paperRepository->changePaperStatus($paper, Config::get('constants.PAPER_STATUS.ALL_REVIEWER_RECOMMENDATION'));
        }
    }
}
