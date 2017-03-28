<?php

namespace App\Listeners;

use App\Events\RealtimeActivityEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RealtimeActivityEventListener
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
     * @param  RealtimeActivityEvent  $event
     * @return void
     */
    public function handle(RealtimeActivityEvent $event)
    {
        //
    }
}
