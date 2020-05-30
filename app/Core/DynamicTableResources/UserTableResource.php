<?php
namespace App\Core\DynamicTableResources;
use App\Entities\User;
use Illuminate\Http\Request;

class UserTableResource
{

    public function getResource(){
        return [
            'resource' => 'User',
            'resolver' => 'UserResolver',

            'url' =>route('api.dynamic.table'),
            'createUrl' =>route('users.create'),
            'editUrl' => route('users.edit', ['user' => 'User']),

            'deleteUrl' => route('bulk-delete'),
            'deleteLabel' => 'Eliminar',
            'deleteModalQuestion' => '¿Esta seguro que desea eliminar este usuario?',

            'restoreUrl' => route('bulk-delete'),
            'restoreLabel' => 'Restaurar',
            'restoreModalQuestion' =>'¿ Esta seguro que desea restaurar este usuario?',

            'perPage' => 10,
            'perPageLabel' => 'Usuarios por página',
            'filters' => ['name', 'email', 'role_list'],
            'emptyTableLabel' => 'No se encontraron registros'
        ];
    }

    public function handle(Request $request)
    {
        $columns = collect([
            ["label" => 'Nombre', "field" => 'name', ],
            ["label" => 'Email',"field" => 'email'],
            ["label" => 'Roles',"field" => 'role_list'],
            ["label" => 'Estado',"field" => 'state'],
        ]);
        $query = new User();
        if(isset($request->columnFilters) && count($request->columnFilters)){
            foreach($request->columnFilters as $key =>  $filter){
                switch ($filter){
                    case'role': break;
                    default:
                        $query = $query->orWhere($filter, 'LIKE', '%'.$request->search_query.'%')
                            ->whereState('1')
                            ->whereHas('roles', function($role){ $role->where('name', '!=', 'Cliente'); });
                    break;
                }
            }
        }
        $query = $query->whereHas('roles', function($role){ $role->where('name', '!=', 'Cliente'); });


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

        $data->each(function($user){
                $user['role_list'] = $user->roleStringList;
        });


        return [
            'paginator' =>$data ,
            'columns' => $columns,
            'filters'=> $request->columnFilters,
            'request' => $request->all()
        ];

    }
}
