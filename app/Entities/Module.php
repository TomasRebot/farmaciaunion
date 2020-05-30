<?php

namespace App\Entities;


use App\Core\Entities\BaseEntity;
use App\Core\interfaces\ComponentInterface;


class Module extends BaseEntity implements ComponentInterface
{

    protected $fillable = [
        'id',
        'name',
        'description',
        'internal_handler',
        'icon',
        'state',
        'order'
    ];
    //

    public function forms()
    {
        return $this->hasMany(Form::class, 'module_id','id');
    }

    public function render()
    {
        $cants = 0;
        $element =  '
       <li class="'.$this->checkActive().'">
            <a href="#" ><i class="'.$this->icon.'"></i> <span class="nav-label">'.$this->name.'</span> <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">';
            foreach($this->forms->where('module_id', '!=', Null)->sortBy('order') as $form){

                if($form->userCanActive()){
                    $element .= $form->render();
                }else{
                    $cants++;
                }
            }
            $element .= '</ul>
        </li>';
         if(count($this->forms) === $cants)
             return '';
        return $element;
    }

    public function checkActive()
    {

        foreach($this->forms as $form){
            if($form->checkActive() === 'active'){
                return 'active';
                break;
            }
        }
        return '';
    }
}
