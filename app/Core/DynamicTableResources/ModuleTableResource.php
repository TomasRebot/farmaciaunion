<?php
namespace App\Core\DynamicTableResources;


use App\Core\Entities\BaseTableResource;
use App\Core\Interfaces\ResourceTableInterface;
use App\Entities\Module;
use Illuminate\Http\Request;

class ModuleTableResource extends BaseTableResource implements ResourceTableInterface
{

    public function getResource(){
        return [
            'page_name' => 'Modulos',

            'resource' => 'Module',
            'resolver' => 'ModuleResolver',


            'permissions' => permissionsTo($this->current_form),

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
            'filters' => ['name', 'description', 'internal_handler','order','state'],
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

        $query = $this->filter($query, $request);

        $query = $this->sort($query, $request);


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
