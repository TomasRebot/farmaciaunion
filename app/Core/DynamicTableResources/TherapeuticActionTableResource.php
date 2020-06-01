<?php
namespace App\Core\DynamicTableResources;
use App\Entities\Drug;

use App\Entities\TherapeuticAction;
use Illuminate\Http\Request;

class TherapeuticActionTableResource
{

    public function getResource(){
        return [

            'page_name' => 'Acciones Terapeuticas',
            'resource' => 'TherapeuticAction',
            'resolver' => 'TherapeuticActionResolver',

            'url' =>route('api.dynamic.table'),
            'createUrl' =>route('therapeutic-actions.create'),
            'editUrl' => route('therapeutic-actions.edit', ['therapeutic_action' => 'TherapeuticAction']),

            'deleteUrl' => route('bulk-delete'),
            'deleteLabel' => 'Eliminar',
            'deleteModalQuestion' => '¿Esta seguro que desea eliminar esta accion terapeutica?',

            'restoreUrl' => route('bulk-delete'),
            'restoreLabel' => 'Restaurar',
            'restoreModalQuestion' =>'¿ Esta seguro que desea restaurar esta accion terapeutica?',

            'perPage' => 10,
            'perPageLabel' => 'Acciones terapeuticas por página',
            'filters' => ['name', 'description'],
            'emptyTableLabel' => 'No se encontraron registros'
        ];
    }

    public function handle(Request $request)
    {
        $columns = collect([
            ["label" => 'Nombre', "field" => 'name', ],
            ["label" => 'Descripcion',"field" => 'description'],
            ["label" => 'Estado',"field" => 'state'],
        ]);
        $query = new TherapeuticAction();

        if(isset($request->columnFilters) && count($request->columnFilters)){
            foreach($request->columnFilters as $key =>  $filter){
                switch ($filter){
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
