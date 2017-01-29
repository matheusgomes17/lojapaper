<?php

namespace Snaketec\Events\Backend\Catalog\Product;

use Snaketec\Events\Event;
use Illuminate\Queue\SerializesModels;

/**
 * Class ProductCreated.
 */
class ProductCreated extends Event
{
    use SerializesModels;

    /**
     * @var
     */
    public $product;

    /**
     * @param $product
     */
    public function __construct($product)
    {
        $this->product = $product;
    }
}
