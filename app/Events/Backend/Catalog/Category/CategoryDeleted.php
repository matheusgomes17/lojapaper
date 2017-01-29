<?php

namespace Snaketec\Events\Backend\Catalog\Category;

use Snaketec\Events\Event;
use Illuminate\Queue\SerializesModels;

/**
 * Class CategoryDeleted.
 */
class CategoryDeleted extends Event
{
    use SerializesModels;

    /**
     * @var
     */
    public $category;

    /**
     * @param $category
     */
    public function __construct($category)
    {
        $this->category = $category;
    }
}
