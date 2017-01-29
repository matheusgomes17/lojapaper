<?php

namespace Snaketec\Models\Catalog\Product\Traits\Scope;
use Illuminate\Support\Facades\DB;

/**
 * Trait ProductScope.
 */
trait ProductScope
{
    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeActive($query, $status = true)
    {
        return $query->where('status', $status);
    }
}