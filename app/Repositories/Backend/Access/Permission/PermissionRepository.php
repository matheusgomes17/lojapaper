<?php

namespace Snaketec\Repositories\Backend\Access\Permission;

use Snaketec\Repositories\Repository;
use Snaketec\Models\Access\Permission\Permission;

/**
 * Class PermissionRepository.
 */
class PermissionRepository extends Repository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Permission::class;
}
