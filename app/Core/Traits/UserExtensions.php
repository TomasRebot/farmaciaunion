<?php


namespace App\Core\Traits;


trait UserExtensions
{
    public function scopeAllAdmins($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->whereNotIn('name', ['Cliente']);
        });
    }

    public function scopeAllClients($query,$state)
    {
        $state = $state === 'active' ? '1' : '0';
        return $query->whereHas('roles', function($q){
            return $q->where('name', 'Cliente');
        })->where('state' , $state);
    }

}
