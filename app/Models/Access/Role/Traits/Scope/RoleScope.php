<?php

namespace Snaketec\Models\Access\Role\Traits\Scope;

/**
 * Trait RoleScope.
 */
trait RoleScope
{
    /**
     * @param $query
     * @param string $direction
     *
     * @return mixed
     */
    public function scopeSort($query, $direction = 'asc')
    {
        return $query->orderBy('sort', $direction);
    }
}
