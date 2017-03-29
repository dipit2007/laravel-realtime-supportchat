<?php

namespace App\Listeners;

use App\Events\SupportChatMessageEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupportChatMessageEventListener
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
     * @param  SupportChatMessageEvent  $event
     * @return void
     */
    public function handle(SupportChatMessageEvent $event)
    {
        //
    }
}
