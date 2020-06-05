<?php

namespace App\Core\DynamicTableResources;

use App\Core\Entities\BaseTableResource;
use App\Core\Interfaces\ResourceTableInterface;
use Illuminate\Http\Request;
use App\Entities\Category;

class CategoryTableResource extends BaseTableResource implements ResourceTableInterface
{
    public function getResource(){
        return [

            'page_name' => 'Categorias',
            'resource' => 'Category',
            'resolver' => 'CategoryResolver',


            'permissions' => permissionsTo($this->current_form),
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

        $query = $this->filter($query,$request);

        $query = $this->sort($query,$request);

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
