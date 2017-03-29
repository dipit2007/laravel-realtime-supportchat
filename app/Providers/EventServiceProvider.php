<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],

        'App\Events\BroadcastMessageEvent' => [
            'App\Listeners\BroadcastMessageEventListener',
        ],

        'App\Events\RealtimeActivityEvent' => [
            'App\Listeners\RealtimeActivityEventListener',
        ],

        'App\Events\SupportChatMessageEvent' => [
            'App\Listeners\SupportChatMessageEventListener',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
