<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Brand extends BaseEntity
{
    protected $fillable = [
        'name',
        'description',
        'origin',
        'state'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
