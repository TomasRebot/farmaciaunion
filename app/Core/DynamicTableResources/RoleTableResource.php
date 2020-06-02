<?php
namespace App\Core\DynamicTableResources;
use App\Entities\Role;
use Illuminate\Http\Request;

class RoleTableResource
{

    public function getResource(){
        return [
            'page_name' => 'Roles',

            'resource' => 'Role',
            'resolver' => 'RoleResolver',

            'url' =>route('api.dynamic.table'),
            'createUrl' =>route('roles.create'),
            'editUrl' => route('roles.edit', ['role' => 'Role']),

            'externalUrl' => route('roles.show', ['role'=>'Role']),
            'externalLabel' => 'Gestionar acciones',

            'deleteUrl' => route('bulk-delete'),
            'deleteLabel' => 'Eliminar',
            'deleteModalQuestion' => '¿Esta seguro que desea eliminar este rol?',

            'restoreUrl' => route('bulk-delete'),
            'restoreLabel' => 'Restaurar',
            'restoreModalQuestion' =>'¿ Esta seguro que desea restaurar este rol?',

            'perPage' => 10,
            'perPageLabel' => 'Roles por página',
            'filters' => ['name', 'description', 'state'],
            'emptyTableLabel' => 'No se encontraron registros'
        ];
    }

    public function handle(Request $request)
    {
        $columns = collect([
            ["label" => 'Nombre', "field" => 'name', ],
            ["label" => 'Descripción',"field" => 'description'],
            ["label" => 'Estado',"field" => 'state'],
        ]);
        $query = Role::forCurrentUserTableResource();

        $idRoles = $query->pluck('id');

        if(isset($request->columnFilters) && count($request->columnFilters)){
            foreach($request->columnFilters as $key =>  $filter){
                switch ($filter){
                    case'role': break;
                    default:
                        $query = $query->orWhere($filter, 'LIKE', '%'.$request->search_query.'%')
                        ->whereIn('id', $idRoles);
                    break;
                }
            }
        }

        $sort = $request->sort;
        if(isset($sort['type']) && isset($sort['field'])){
            switch ($sort['field']){
                case'role': break;
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
