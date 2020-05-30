<?php
namespace App\Core\DynamicTableResources;


use App\Entities\Form;
use Illuminate\Http\Request;

class FormsTableResource
{

    public function getResource(){
        return [
            'resource' => 'Form',
            'resolver' => 'FormResolver',

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
            'filters' => ['name', 'description', 'internal_handler','icon','order','state'],
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

        if(isset($request->columnFilters) && count($request->columnFilters)){
            foreach($request->columnFilters as $key =>  $filter){
                switch ($filter){
                    case'role': break;
                    default:
                        $query = $query->orWhere($filter, 'LIKE', '%'.$request->search_query.'%');
                    break;
                }
            }
        }


        $sort = $request->sort;
        if(isset($sort['type']) && isset($sort['field'])){
            switch ($sort['field']){
                case 'module_name':
                    $query->with(['module' => function($module) use($sort){
                        $field = ($sort['field'] != '') ? $sort['field'] : null;
                        $type = ($sort['type'] != '') ? $sort['type'] : null;
                        if(!is_null($field) && !is_null($type)){
                            $module->orderBy('name', $type);
                        }
                    }]);
                break;
                default:
                    $field = ($sort['field'] != '') ? $sort['field'] : null;
                    $type = ($sort['type'] != '') ? $sort['type'] : null;
                    if(!is_null($field) && !is_null($type)){
                        $query = $query->orderBy($field, $type);
                    }

                break;
            }
        }

        $data = $query->paginate($request->per_page)->appends(
            ['sort' => $request->sort]);

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
}
