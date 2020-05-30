<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Permission extends BaseEntity
{

    protected $fillable = [
        'action',
        'icon',
        'description',
        'name'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions_forms' , 'permission_id' );
    }

    public function forms()
    {
        return $this->belongsToMany(Form::class, 'role_permissions_forms' , 'permission_id' );
    }
}
