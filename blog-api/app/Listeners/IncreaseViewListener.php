<?php

namespace App\Listeners;

use App\Events\IncreaseView;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseViewListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(IncreaseView $event): void
    {
        $event->post->increment('post_views');
    }
}
