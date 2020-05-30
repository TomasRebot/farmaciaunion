<?php
namespace App\Core\DynamicTableResources;
use App\Entities\User;
use Illuminate\Http\Request;

class ActiveClientTableResource
{

    public function getResource(){
        return [
            'resource' => 'Client',
            'resolver' => 'ActiveClients',

            'url' =>route('api.dynamic.table'),
            'createUrl' =>route('clients.create'),
            'editUrl' => route('clients.edit', ['client' => 'Client']),

            'deleteUrl' => route('bulk-delete'),
            'deleteLabel' => 'Suspender',
            'deleteModalQuestion' => '¿Esta seguro que desea suspender este cliente?',

            'restoreUrl' => null,
            'restoreLabel' => null,
            'restoreModalQuestion' =>null,

            'perPage' => 10,
            'perPageLabel' => 'Clientes por página',
            'filters' => ['name', 'email'],
            'emptyTableLabel' => 'No se encontraron registros'
        ];
    }

    public function handle(Request $request)
    {
        $columns = collect([
            ["label" => 'Nombre', "field" => 'name', ],
            ["label" => 'Email',"field" => 'email'],
            ["label" => 'Estado',"field" => 'state'],
        ]);
        $query = new User();
        if(isset($request->columnFilters) && count($request->columnFilters)){
            foreach($request->columnFilters as $key =>  $filter){
                $query = $query->orWhere($filter, 'LIKE', '%'.$request->search_query.'%')
                    ->whereState('1')
                    ->whereHas('roles', function($role){ $role->where('name', 'Cliente'); });
            }
        }
        $query = $query->whereHas('roles', function($role){ $role->where('name', 'Cliente'); })
            ->whereState('1')
            ->select('name','email','state','id');
        $sort = $request->sort;
        if(isset($sort['type']) && isset($sort['field'])){
            $field = ($sort['field'] != '') ? $sort['field'] : null;
            $type = ($sort['type'] != '') ? $sort['type'] : null;
            if(!is_null($field) && !is_null($type)){
                $query = $query->orderBy($field, $type);
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
