<?php

namespace Snaketec\Models\Catalog\Category\Traits\Scope;

/**
 * Trait CategoryScope.
 */
trait CategoryScope
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
