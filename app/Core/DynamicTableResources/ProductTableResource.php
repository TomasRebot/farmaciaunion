<?php

namespace App\Core\DynamicTableResources;

use App\Core\Entities\BaseTableResource;
use App\Core\Interfaces\ResourceTableInterface;
use Illuminate\Http\Request;
use App\Entities\Product;

class ProductTableResource extends BaseTableResource implements ResourceTableInterface
{
    public function getResource(){
        return [

            'page_name' => 'Productos',
            'resource' => 'Product',
            'resolver' => 'ProductResolver',


            'permissions' => permissionsTo($this->current_form),

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
            'filters' => ['name','state', 'description','presentation','die_number','drug'],
            'emptyTableLabel' => 'No se encontraron registros'
        ];
    }

    public function handle(Request $request)
    {
        $columns = collect([
            ["label" => 'Nombre', "field" => 'name', ],
            ["label" => 'Nro troquel',"field" => 'die_number'],
            ["label" => 'Presentacion',"field" => 'presentation'],
            ["label" => 'Droga',"field" => 'droga'],
            ["label" => 'Estado',"field" => 'state'],
        ]);
        $query = new Product();


        $query = $this->filter($query, $request);
        $query = $this->sort($query, $request);

        $data = $query->paginate($request->per_page)->appends(
            ['sort' => $request->sort]);

        $data->each(function($product){
            $product['droga'] = isset( $product->drug) ?  $product->drug->name : 'no tiene';
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
                    case'drug':
                        $query = $query->orWhereHas('drug', function($module)use($request){
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


}
