<?php

namespace App\Entities;

use App\Core\Entities\BaseEntity;


use App\Core\Traits\RulesManager;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Role extends BaseEntity
{
    use RulesManager;

    protected $fillable = [
        'name',
        'description',
        'state'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class,'user_roles'  ,'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions_forms' , 'role_id','permission_id' );
    }

    public function forms()
    {
        return $this->belongsToMany(Form::class, 'role_permissions_forms' , 'role_id', 'form_id' );
    }

    public function scopeForCurrentUser(){
        if(isCurrentSuperAdmin()){
            return $this->all();
        }else{
            return $this->whereNotIn('name', ['Cliente' ,'Super usuario'] )->where('state', 1)->get();
        }
    }

}
