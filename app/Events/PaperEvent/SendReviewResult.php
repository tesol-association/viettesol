<?php

namespace App\Events\PaperEvent;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\ReviewAssignment;

class SendReviewResult
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $reviewAssignment;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ReviewAssignment $reviewAssignment)
    {
        $this->reviewAssignment = $reviewAssignment;
    }
}
