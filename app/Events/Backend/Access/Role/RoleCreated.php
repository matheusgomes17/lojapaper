<?php

namespace Snaketec\Events\Backend\Access\Role;

use Snaketec\Events\Event;
use Illuminate\Queue\SerializesModels;

/**
 * Class RoleCreated.
 */
class RoleCreated extends Event
{
    use SerializesModels;

    /**
     * @var
     */
    public $role;

    /**
     * @param $role
     */
    public function __construct($role)
    {
        $this->role = $role;
    }
}
