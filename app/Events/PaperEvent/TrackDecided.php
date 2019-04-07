<?php

namespace App\Events\PaperEvent;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\TrackDecision;

class TrackDecided
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $decision;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(TrackDecision $trackDecision)
    {
        $this->decision = $trackDecision;
    }
}
