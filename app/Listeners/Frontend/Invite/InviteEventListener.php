<?php

namespace App\Listeners\Frontend\Invite;

/**
 * Class InviteEventListener.
 */
class InviteEventListener
{
    /**
     * @param $event
     */
    public function onRequested($event)
    {
        \Log::info('Invite Requested: '.$event->user->first_name . ' ' . $event->user->last_name);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Frontend\Invite\InviteRequested::class,
            'App\Listeners\Frontend\Invite\InviteEventListener@onRequested'
        );
    }
}
