<?php

namespace Snaketec\Events\Frontend\Auth;

use Snaketec\Events\Event;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserConfirmed.
 */
class UserConfirmed extends Event
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
