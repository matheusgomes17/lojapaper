<?php

namespace Snaketec\Models\Access\Permission\Traits\Relationship;

/**
 * Trait PermissionRelationship.
 */
trait PermissionRelationship
{
    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(config('access.role'), config('access.permission_role_table'), 'permission_id', 'role_id');
    }
}
