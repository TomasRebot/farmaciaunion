<?php
namespace App\Core\DynamicTableResources;
use App\Entities\Permission;

use Illuminate\Http\Request;

class PermissionTableResource
{

    public function getResource(){
        return [
            'resource' => 'Permission',
            'resolver' => 'PermissionResolver',

            'url' =>route('api.dynamic.table'),
            'createUrl' =>route('permissions.create'),
            'editUrl' => route('permissions.edit', ['permission' => 'Permission']),

            'deleteUrl' => route('bulk-delete'),
            'deleteLabel' => 'Eliminar',
            'deleteModalQuestion' => '¿Esta seguro que desea eliminar este permiso?',

            'restoreUrl' => route('bulk-delete'),
            'restoreLabel' => 'Restaurar',
            'restoreModalQuestion' =>'¿ Esta seguro que desea restaurar este permiso?',

            'perPage' => 10,
            'perPageLabel' => 'Permisos por página',
            'filters' => ['name', 'email', 'role_list'],
            'emptyTableLabel' => 'No se encontraron registros'
        ];
    }

    public function handle(Request $request)
    {
        $columns = collect([
            ["label" => 'Nombre', "field" => 'name', ],
            ["label" => 'Descripcion',"field" => 'description'],
            ["label" => 'Acción',"field" => 'action'],
            ["label" => 'Icono',"field" => 'icon'],
        ]);
        $query = new Permission();

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
