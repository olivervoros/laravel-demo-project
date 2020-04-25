<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FlightDepartedLateEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $flightNumber;
    public $destination;
    public $delayedMinutes;

    /**
     * Create a new event instance.
     *
     * @param $flightNumber
     * @param $destination
     * @param $delayedMinutes
     */
    public function __construct($flightNumber, $destination, $delayedMinutes = 0)
    {
        $this->flightNumber = $flightNumber;
        $this->destination = $destination;
        $this->delayedMinutes = $delayedMinutes;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('flight-info');
    }
}
