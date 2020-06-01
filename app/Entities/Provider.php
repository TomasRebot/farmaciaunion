<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Provider extends BaseEntity
{
    protected $fillable = [
        'id',
        'state',
        'name',
        'description',
    ];


}
