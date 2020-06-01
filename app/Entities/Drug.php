<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


class Drug extends BaseEntity
{

    protected $table = 'drugs';

    protected $fillable = [
        'id',
        'name',
        'description',
        'merlin_id',
        'state',
    ];

    public function therpaeuticActions()
    {
        return $this->belongsToMany(TherapeuticAction::class, 'drugs_therapeutic_actions','drug_id');
    }
    public function getTherpaeuticActionsToStringAttribute()
    {
        $therapeutic_action_list = '';
        $self_therapeutics = $this->therpaeuticActions;
        $length = count($self_therapeutics);
        foreach($self_therapeutics as $key => $role)
        {
            $therapeutic_action_list .= $role->name.'';

            if($key <  $length -1 ){
                $therapeutic_action_list .=  ', ';
            }
        }
        return $therapeutic_action_list;
    }



}
