<?php


namespace App\Core\Entities;
use App\Entities\Form;
use App\Entities\Module;




use App\Core\interfaces\ComponentInterface;
use Illuminate\Support\Facades\Route;

class Menu implements ComponentInterface
{

    protected $componentList;

    public function __construct(ComponentInterface $moduleList, ComponentInterface $formList)
    {
        $modules = $moduleList->all();
        $forms = $formList->where('module_id', null)->orderBy('order')->get();
        $forms->each(function($form)use($modules){
            if($form->userCanActive()){
                $modules->push($form);
            }
        });
        $this->componentList = $modules->sortBy('order');
    }

    public function render()
    {
        $element = '';
        foreach($this->componentList->sortBy('order') as $component){
            $element .=  $component->render();
        }
        echo $element;
    }

    public function checkActive()
    {
        return Route::current()->uri === 'panel' ? 'active' : '';
    }
}
