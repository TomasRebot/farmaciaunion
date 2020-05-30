<?php

namespace App\Entities;


use App\Core\Entities\BaseEntity;
use App\Core\interfaces\ComponentInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Form extends BaseEntity implements ComponentInterface
{


    protected $fillable = [
        'module_id',
        'name',
        'key',
        'target',
        'icon',
        'state',
        'order'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions_forms' , 'form_id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions_forms' , 'permission_id' );
    }
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id','id');
    }


    public function getModuleNameStringAttribute()
    {
        return $this->module->name;
    }
    public function getUsersAttribute()
    {
        $filtered = new Collection();
        foreach($this->roles as $rol){
            $filtered->push($rol->users->unique());
        }
        return $filtered;
    }

    public function render()
    {
        if($this->checkState()){

            return '
             <li class="'.$this->checkActive().'">
                <a href="'.url($this->target).'">
                <i class="'.$this->icon.'"></i>
                  '.$this->wrap().'
                </a>
            </li>
        ';
        }else{
            return false;
        }
    }

    public function wrap()
    {
        if(!$this->module_id)
        {
            return '  <span class="nav-label">
                        '.$this->name.'
                    </span>';
        }else{
            return $this->name;
        }
    }

    public function checkActive()
    {

        $current = Route::current()->uri;

        $atLeast = Str::contains( $current, $this->target);

        if($atLeast || $current === $this->target){
            return 'active';
        }else{
            return '';
        }
    }

    public function userCanActive(){


        $collection = Auth::user()->forms->find($this);

        if($collection && $collection->count()){
            return true;
        }
        else{
            return false;
        }
    }

    public function checkState(){
        if(isset($this->attributes['state'])){
            return $this->state === '1';
        }
        return true;
    }
}
