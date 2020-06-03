<?php
namespace App\Core\DynamicTableResources;
use App\Core\Entities\BaseTableResource;
use App\Core\Interfaces\ResourceTableInterface;
use App\Entities\Drug;

use App\Entities\TherapeuticAction;
use Illuminate\Http\Request;

class TherapeuticActionTableResource extends BaseTableResource implements ResourceTableInterface
{

    public function getResource(){
        return [

            'page_name' => 'Acciones Terapeuticas',
            'resource' => 'TherapeuticAction',
            'resolver' => 'TherapeuticActionResolver',

            'permissions' => permissionsTo($this->current_form),

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
