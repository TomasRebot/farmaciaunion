<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Category extends BaseEntity
{

    protected $fillable = [
        'id',
        'name',
        'description',
        'state',
        'merlin_id'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
