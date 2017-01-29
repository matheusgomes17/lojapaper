<?php

namespace Snaketec\Listeners\Backend\Catalog\Product;

/**
 * Class ProductEventListener.
 */
class ProductEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Product';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->log(
            $this->history_slug,
            'trans("history.backend.catalog.products.created") '.$event->product->name,
            $event->product->id,
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
            'trans("history.backend.catalog.products.updated") '.$event->product->name,
            $event->product->id,
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
            'trans("history.backend.catalog.products.deleted") '.$event->product->name,
            $event->product->id,
            'trash',
            'bg-maroon'
        );
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        history()->log(
            $this->history_slug,
            'trans("history.backend.catalog.products.restored") '.$event->product->name,
            $event->product->id,
            'refresh',
            'bg-aqua'
        );
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        history()->log(
            $this->history_slug,
            'trans("history.backend.catalog.products.permanently_deleted") '.$event->product->name,
            $event->product->id,
            'trash',
            'bg-maroon'
        );
    }

    /**
     * @param $event
     */
    public function onDeactivated($event)
    {
        history()->log(
            $this->history_slug,
            'trans("history.backend.catalog.products.deactivated") '.$event->product->name,
            $event->product->id,
            'times',
            'bg-yellow'
        );
    }

    /**
     * @param $event
     */
    public function onReactivated($event)
    {
        history()->log(
            $this->history_slug,
            'trans("history.backend.catalog.products.reactivated") '.$event->product->name,
            $event->product->id,
            'check',
            'bg-green'
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
            \Snaketec\Events\Backend\Catalog\Product\ProductCreated::class,
            'Snaketec\Listeners\Backend\Catalog\Product\ProductEventListener@onCreated'
        );

        $events->listen(
            \Snaketec\Events\Backend\Catalog\Product\ProductUpdated::class,
            'Snaketec\Listeners\Backend\Catalog\Product\ProductEventListener@onUpdated'
        );

        $events->listen(
            \Snaketec\Events\Backend\Catalog\Product\ProductDeleted::class,
            'Snaketec\Listeners\Backend\Catalog\Product\ProductEventListener@onDeleted'
        );

        $events->listen(
            \Snaketec\Events\Backend\Catalog\Product\ProductRestored::class,
            'Snaketec\Listeners\Backend\Catalog\Product\ProductEventListener@onRestored'
        );

        $events->listen(
            \Snaketec\Events\Backend\Catalog\Product\ProductPermanentlyDeleted::class,
            'Snaketec\Listeners\Backend\Catalog\Product\ProductEventListener@onPermanentlyDeleted'
        );

        $events->listen(
            \Snaketec\Events\Backend\Catalog\Product\ProductDeactivated::class,
            'Snaketec\Listeners\Backend\Catalog\Product\ProductEventListener@onDeactivated'
        );

        $events->listen(
            \Snaketec\Events\Backend\Catalog\Product\ProductReactivated::class,
            'Snaketec\Listeners\Backend\Catalog\Product\ProductEventListener@onReactivated'
        );
    }
}
