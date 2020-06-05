<?php
namespace App\Core\DynamicTableResources;
use App\Core\Entities\BaseTableResource;
use App\Core\Interfaces\ResourceTableInterface;
use App\Entities\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleTableResource extends BaseTableResource implements ResourceTableInterface
{

    public function getResource(){

        return [
            'page_name' => 'Roles',
            'permissions' => permissionsTo($this->current_form),
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

        $query = $this->filter($query, $request)->whereIn('id', $query->pluck('id'));

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
