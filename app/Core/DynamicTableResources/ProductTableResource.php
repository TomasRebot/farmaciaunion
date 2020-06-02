<?php

namespace App\Core\DynamicTableResources;

use Illuminate\Http\Request;
use App\Entities\Product;

class ProductTableResource
{
    public function getResource(){
        return [

            'page_name' => 'Productos',
            'resource' => 'Product',
            'resolver' => 'ProductResolver',

            'url' =>route('api.dynamic.table'),
            'createUrl' =>route('products.create'),
            'editUrl' => route('products.edit', ['product' => 'Product' ]),

            'deleteUrl' => route('bulk-delete'),
            'deleteLabel' => 'Eliminar',
            'deleteModalQuestion' => '¿Esta seguro que desea eliminar este producto?',

            'restoreUrl' => route('bulk-delete'),
            'restoreLabel' => 'Restaurar',
            'restoreModalQuestion' =>'¿ Esta seguro que desea restaurar este producto?',

            'perPage' => 10,
            'perPageLabel' => 'Productos por página',
            'filters' => ['name','state', 'description'],
            'emptyTableLabel' => 'No se encontraron registros'
        ];
    }

    public function handle(Request $request)
    {
        $columns = collect([
            ["label" => 'Nombre', "field" => 'name', ],
            ["label" => 'Nro troquel',"field" => 'die_number'],
            ["label" => 'Presentacion',"field" => 'presentation'],
            ["label" => 'Estado',"field" => 'state'],
        ]);
        $query = new Product();
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
