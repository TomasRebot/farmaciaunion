<?php
namespace App\Core\DynamicTableResources;


use App\Entities\Module;
use Illuminate\Http\Request;

class ModuleTableResource
{

    public function getResource(){
        return [
            'page_name' => 'Modulos',

            'resource' => 'Module',
            'resolver' => 'ModuleResolver',

            'url' =>route('api.dynamic.table'),
            'createUrl' =>route('modules.create'),
            'editUrl' => route('modules.edit', ['module' => 'Module']),

            'deleteUrl' => route('bulk-delete'),
            'deleteLabel' => 'Desactivar',
            'deleteModalQuestion' => '¿Esta seguro que desea desactivar este modulo?',

            'restoreUrl' => route('bulk-delete'),
            'restoreLabel' => 'Restaurar',
            'restoreModalQuestion' =>'¿ Esta seguro que desea restaurar este modulo?',

            'perPage' => 10,
            'perPageLabel' => 'Módulos por página',
            'filters' => ['name', 'email', 'description','internal_handler','icon','order'],
            'emptyTableLabel' => 'No se encontraron registros'
        ];
    }

    public function handle(Request $request)
    {
        $columns = collect([
            ["label" => 'Nombre', "field" => 'name', ],
            ["label" => 'Descripcion',"field" => 'description'],
            ["label" => 'Relacion interna', "field" => 'internal_handler'],
            ["label" => 'Icono',"field" => 'icon'],
            ["label" => 'Orden',"field" => 'order'],
            ["label" => 'Estado',"field" => 'state'],
        ]);
        $query = new Module();

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



        return [
            'paginator' =>$data ,
            'columns' => $columns,
            'filters'=> $request->columnFilters,
            'request' => $request->all()
        ];

    }
}
