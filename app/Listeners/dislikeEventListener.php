<?php

namespace App\Listeners;

use App\Events\dislikeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class dislikeEventListener
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
     * @param  dislikeEvent  $event
     * @return void
     */
    public function handle(dislikeEvent $event)
    {
        //
    }
}
