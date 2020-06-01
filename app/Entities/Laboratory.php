<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Laboratory extends BaseEntity
{
    protected $fillable = [
        'id',
        'merlin_id',
        'name',
        'description',
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'laboratory_id', 'id');
    }
}
