<?php

namespace App\Listeners\Backend\Base;

use App\Events\Backend\Base\Created;
use App\Events\Backend\Base\Updated;
use App\Events\Backend\Base\Deleted;
use App\Events\Backend\Base\Restored;
use App\Events\Backend\Base\ForceDeleted;

/**
 * Class BaseEventListener.
 */
class BaseEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($event->history)
            ->withEntity($event->content->id)
            ->withText('trans("base.history.created") <strong>'.$event->content->event_name.'</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->withType($event->history)
            ->withEntity($event->content->id)
            ->withText('trans("base.history.updated") <strong>'.$event->content->event_name.'</strong>')
            ->withIcon('save')
            ->withClass('bg-aqua')
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($event->history)
            ->withEntity($event->content->id)
            ->withText('trans("base.history.deleted") <strong>'.$event->content->event_name.'</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->log();
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        history()->withType($event->history)
            ->withEntity($event->content->id)
            ->withText('trans("base.history.restored") <strong>'.$event->content->event_name.'</strong>')
            ->withIcon('refresh')
            ->withClass('bg-aqua')
            ->log();
    }

    /**
     * @param $event
     */
    public function onForceDeleted($event)
    {
        history()->withType($event->history)
            ->withEntity($event->content->id)
            ->withText('trans("base.history.permanently_deleted") <strong>'.$event->content->event_name.'</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->log();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen( Created::class,            'App\Listeners\Backend\Base\BaseEventListener@onCreated'           );
        $events->listen( Updated::class,            'App\Listeners\Backend\Base\BaseEventListener@onUpdated'           );
        $events->listen( Deleted::class,            'App\Listeners\Backend\Base\BaseEventListener@onDeleted'           );
        $events->listen( Restored::class,           'App\Listeners\Backend\Base\BaseEventListener@onRestored'          );
        $events->listen( ForceDeleted::class,       'App\Listeners\Backend\Base\BaseEventListener@onForceDeleted');
    }
}
