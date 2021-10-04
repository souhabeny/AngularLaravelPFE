<?php

namespace App\Listeners;

use App\Events\likeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class likeEventListener
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
     * @param  likeEvent  $event
     * @return void
     */
    public function handle(likeEvent $event)
    {
        //
    }
}
