<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class TherapeuticAction extends BaseEntity
{
    protected $table = 'therapeutic_actions';

    public $onSoftDelete = 'toggleState';

    protected $fillable = [
        'id',
        'merlin_id',
        'name',
        'description',
    ];

    public function drugs()
    {
        return $this->belongsToMany(Drug::class, 'drugs_therapeutic_actions','therapeutic_action_id');
    }


}
