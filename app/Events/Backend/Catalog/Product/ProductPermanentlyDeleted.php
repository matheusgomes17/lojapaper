<?php

namespace Snaketec\Events\Backend\Catalog\Product;

use Snaketec\Events\Event;
use Illuminate\Queue\SerializesModels;

/**
 * Class ProductPermanentlyDeleted.
 */
class ProductPermanentlyDeleted extends Event
{
    use SerializesModels;

    /**
     * @var
     */
    public $product;

    /**
     * @param $user
     */
    public function __construct($product)
    {
        $this->product = $product;
    }
}
