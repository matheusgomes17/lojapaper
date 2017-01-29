<?php

namespace Snaketec\Events\Backend\Access\User;

use Snaketec\Events\Event;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserReactivated.
 */
class UserReactivated extends Event
{
    use SerializesModels;

    /**
     * @var
     */
    public $user;

    /**
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
