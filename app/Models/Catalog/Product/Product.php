<?php

namespace Snaketec\Models\Catalog\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Snaketec\Models\Catalog\Product\Traits\Attribute\ProductAttribute;
use Snaketec\Models\Catalog\Product\Traits\Mutator\ProductMutator;
use Snaketec\Models\Catalog\Product\Traits\ProductAccess;
use Snaketec\Models\Catalog\Product\Traits\Relationship\ProductRelationship;
use Snaketec\Models\Catalog\Product\Traits\Scope\ProductScope;

/**
 * Class Product.
 */
class Product extends Model
{
    use ProductScope,
        ProductAccess,
        Notifiable,
        SoftDeletes,
        ProductAttribute,
        ProductMutator,
        ProductRelationship;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'category_id', 'name', 'description', 'code', 'image', 'status'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('catalog.products_table');
    }
}
