<?php
namespace App\Core\DynamicTableResources;


use App\Core\Entities\BaseTableResource;
use App\Core\Interfaces\ResourceTableInterface;
use App\Entities\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FormsTableResource extends BaseTableResource implements ResourceTableInterface
{

    public function getResource(){
        return [
            'page_name' => 'Formularios',

            'resource' => 'Form',
            'resolver' => 'FormResolver',

            'permissions' => permissionsTo($this->current_form),

            'url' =>route('api.dynamic.table'),
            'createUrl' =>route('forms.create'),
            'editUrl' => route('forms.edit', ['form' => 'Form']),

            'deleteUrl' => route('bulk-delete'),
            'deleteLabel' => 'Desactivar',
            'deleteModalQuestion' => '¿Esta seguro que desea desactivar este formulario?',

            'restoreUrl' => route('bulk-delete'),
            'restoreLabel' => 'Restaurar',
            'restoreModalQuestion' =>'¿ Esta seguro que desea restaurar este formulario?',

            'perPage' => 10,
            'perPageLabel' => 'Formularios por página',

            'filters' => ['name', 'key','target','order','state', 'module'],
            'emptyTableLabel' => 'No se encontraron registros'
        ];
    }

    public function handle(Request $request)
    {
        $columns = collect([
            ["label" => 'Nombre', "field" => 'name', ],
            ["label" => 'Módulo',"field" => 'module_name'],
            ["label" => 'Ruta', "field" => 'target'],
            ["label" => 'Orden',"field" => 'order'],
            ["label" => 'Estado',"field" => 'state'],
        ]);

        $query = new Form();

        $query = $this->filter($query,$request);

        $query = $this->sort($query,$request);

        $data = $query->paginate($request->per_page)->appends( ['sort' => $request->sort]);

        $data->each(function($form){
            $form['module_name'] = $form->moduleNameString;
        });

        return [
            'paginator' =>$data ,
            'columns' => $columns,
            'filters'=> $request->columnFilters,
            'request' => $request->all()
        ];

    }

    public function filter($query, $request)
    {
        if(isset($request->columnFilters) && count($request->columnFilters)){
            foreach($request->columnFilters as $key =>  $filter){
                switch ($filter){
                    case 'module':
                        $query = $query->orWhereHas('module', function($module)use($request){
                            $module->where('name',  'LIKE', '%'.$request->search_query.'%');
                        });
                        break;
                    default:
                        $query = $query->orWhere($filter, 'LIKE', '%'.$request->search_query.'%');
                        break;
                }
            }
        }
        return $query;
    }

    public function sort($query, $request)
    {
        $sort = $request->sort;
        if(isset($sort['type']) && isset($sort['field'])){
            switch ($sort['field']){
                case 'module_name':break;
                default:
                    $query = parent::sort($query,$request);
                    break;
            }
        }
        return $query;
    }
}
