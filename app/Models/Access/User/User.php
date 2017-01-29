<?php

namespace Snaketec\Models\Access\User;

use Illuminate\Notifications\Notifiable;
use Snaketec\Models\Access\User\Traits\UserAccess;
use Illuminate\Database\Eloquent\SoftDeletes;
use Snaketec\Models\Access\User\Traits\Scope\UserScope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Snaketec\Models\Access\User\Traits\UserSendPasswordReset;
use Snaketec\Models\Access\User\Traits\Attribute\UserAttribute;
use Snaketec\Models\Access\User\Traits\Relationship\UserRelationship;

/**
 * Class User.
 */
class User extends Authenticatable
{
    use UserScope,
        UserAccess,
        Notifiable,
        SoftDeletes,
        UserAttribute,
        UserRelationship,
        UserSendPasswordReset;

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
    protected $fillable = ['name', 'email', 'password', 'status', 'confirmation_code', 'confirmed'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

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
        $this->table = config('access.users_table');
    }
}
