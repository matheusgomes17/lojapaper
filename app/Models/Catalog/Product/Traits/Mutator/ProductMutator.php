<?php

namespace Snaketec\Models\Catalog\Product\Traits\Mutator;

/**
 * Trait ProductRelationship.
 */
trait ProductMutator
{
    /**
     * @param  string $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * @param  string $value
     * @return string
     */
    public function getCodeAttribute($value)
    {
        return strtoupper($value);
    }
}