<?php
namespace App\Core\DynamicTableResources;
use App\Core\Entities\BaseTableResource;
use App\Core\Interfaces\ResourceTableInterface;
use App\Entities\Permission;

use Illuminate\Http\Request;

class PermissionTableResource extends BaseTableResource implements ResourceTableInterface
{

    public function getResource(){
        return [
            'page_name' => 'Permisos',

            'resource' => 'Permission',
            'resolver' => 'PermissionResolver',

            'permissions' => permissionsTo($this->current_form),

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
            'filters' => ['name', 'description', 'action' , 'icon'],
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
