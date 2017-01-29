<?php

namespace Snaketec\Listeners\Backend\Catalog\Category;

/**
 * Class CategoryEventListener.
 */
class CategoryEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Category';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->log(
            $this->history_slug,
            'trans("history.backend.catalog.categories.created") '.$event->category->name,
            $event->category->id,
            'plus',
            'bg-green'
        );
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->log(
            $this->history_slug,
            'trans("history.backend.catalog.categories.updated") '.$event->category->name,
            $event->category->id,
            'save',
            'bg-aqua'
        );
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->log(
            $this->history_slug,
            'trans("history.backend.catalog.categories.deleted") '.$event->category->name,
            $event->category->id,
            'trash',
            'bg-maroon'
        );
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \Snaketec\Events\Backend\Catalog\Category\CategoryCreated::class,
            'Snaketec\Listeners\Backend\Catalog\Category\CategoryEventListener@onCreated'
        );

        $events->listen(
            \Snaketec\Events\Backend\Catalog\Category\RoleUpdated::class,
            'Snaketec\Listeners\Backend\Catalog\Category\CategoryEventListener@onUpdated'
        );

        $events->listen(
            \Snaketec\Events\Backend\Catalog\Category\CategoryDeleted::class,
            'Snaketec\Listeners\Backend\Catalog\Category\CategoryEventListener@onDeleted'
        );
    }
}
