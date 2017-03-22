<?php

namespace App\Listeners;

use App\Events\BroadcastMessageEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BroadcastMessageEventListener
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
     * @param  BroadcastMessageEvent  $event
     * @return void
     */
    public function handle(BroadcastMessageEvent $event)
    {
        //
    }
}
