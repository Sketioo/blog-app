<?php

namespace App\Listeners;

use App\Events\PostDeleting;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostDeletingListener
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
    public function handle(PostDeleting $event): void
    {
        $event->post->comments()->delete();
    }
}
