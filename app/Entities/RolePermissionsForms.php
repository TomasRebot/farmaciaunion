<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class RolePermissionsForms extends BaseEntity
{

    protected $fillable = [
        'role_id',
        'permission_id',
        'form_id',
    ];


}
