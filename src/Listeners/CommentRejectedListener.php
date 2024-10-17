<?php

namespace amanuel\Comment\Listeners;

use amanuel\Comment\Notifications\CommentApprovedNotification;
use amanuel\Comment\Notifications\CommentRejectedNotification;

class CommentRejectedListener
{
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $event->comment->user->notify(new CommentRejectedNotification($event->comment));
    }
}
