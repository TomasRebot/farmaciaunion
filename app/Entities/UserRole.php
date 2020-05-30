<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class UserRole extends BaseEntity
{
    protected $table = 'user_roles';

    protected $fillable = [
        'role_id',
        'id',
        'user_id'
    ];
}
