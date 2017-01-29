<?php

namespace Snaketec\Models\Catalog\Category\Traits\Relationship;

/**
 * Trait CategoryRelationship.
 */
trait CategoryRelationship
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(config('catalog.user'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(config('catalog.product'));
    }
}
