<?php

namespace App\Entities;

class Client extends User
{

    protected $table = 'users';


    public function scopeActiveClients($query)
    {
        return $query->actives()
        ->whereHas('roles', function($role){ $role->where('name', 'Cliente'); });
    }
    public function scopeUnactiveClients($query)
    {
        return $query->unactives()
            ->whereHas('roles', function($role){ $role->where('name', 'Cliente'); });
    }

}
