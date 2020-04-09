<?php

namespace App\Listeners;

use App\Providers\RegisteredUserWonEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationEmailListener implements ShouldQueue
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
     * @param  RegisteredUserWonEvent  $event
     * @return void
     */
    public function handle(RegisteredUserWonEvent $event)
    {
        sleep(10); // Simulate a resource heavy job

        dump("Email has been sent to: ".$event->getUser()->email);
    }
}
