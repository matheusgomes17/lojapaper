<?php

namespace Snaketec\Models\Catalog\Category;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Snaketec\Models\Catalog\Category\Traits\Attribute\CategoryAttribute;
use Snaketec\Models\Catalog\Category\Traits\CategoryAccess;
use Snaketec\Models\Catalog\Category\Traits\Relationship\CategoryRelationship;
use Snaketec\Models\Catalog\Category\Traits\Scope\CategoryScope;

/**
 * Class Category.
 */
class Category extends Model
{
    use CategoryScope,
        CategoryAccess,
        Notifiable,
        CategoryAttribute,
        CategoryRelationship,
        NodeTrait;

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
    protected $fillable = ['name', 'description', 'user_id', '_lft', '_rgt', 'parent_id'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('catalog.categories_table');
    }
}
