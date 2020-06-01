<?php

namespace App\Core\DynamicTableResources;

use Illuminate\Http\Request;
use App\Entities\Category;

class CategoryTableResource
{
    public function getResource(){
        return [

            'page_name' => 'Categorias',
            'resource' => 'Category',
            'resolver' => 'CategoryResolver',

            'url' =>route('api.dynamic.table'),
            'createUrl' =>route('categories.create'),
            'editUrl' => route('categories.edit', ['category' => 'Category' ]),

            'deleteUrl' => route('bulk-delete'),
            'deleteLabel' => 'Eliminar',
            'deleteModalQuestion' => '¿Esta seguro que desea eliminar esta categoria?',

            'restoreUrl' => route('bulk-delete'),
            'restoreLabel' => 'Restaurar',
            'restoreModalQuestion' =>'¿ Esta seguro que desea restaurar esta categoria?',

            'perPage' => 10,
            'perPageLabel' => 'Categorias por página',
            'filters' => ['name','state', 'description'],
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
        $query = new Category();
        if(isset($request->columnFilters) && count($request->columnFilters)){
            foreach($request->columnFilters as $key =>  $filter){
                switch ($filter){
                    default:
                        $query = $query->orWhere($filter, 'LIKE', '%'.$request->search_query.'%')
                            ->whereState('1');
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