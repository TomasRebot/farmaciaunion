<?php
namespace App\Core\DynamicTableResources;
use App\Core\Entities\BaseTableResource;
use App\Core\Interfaces\ResourceTableInterface;
use App\Entities\Laboratory;
use Illuminate\Http\Request;

class LaboratoryTableResource extends BaseTableResource implements ResourceTableInterface
{

    public function getResource(){
        return [

            'page_name' => 'Laboratorios',
            'resource' => 'Laboratory',
            'resolver' => 'LaboratoryResolver',

            'permissions' => permissionsTo($this->current_form),

            'url' =>route('api.dynamic.table'),
            'createUrl' =>route('laboratories.create'),
            'editUrl' => route('laboratories.edit', ['laboratory' => 'Laboratory']),

            'deleteUrl' => route('bulk-delete'),
            'deleteLabel' => 'Eliminar',
            'deleteModalQuestion' => '¿Esta seguro que desea eliminar este laboratorio?',

            'restoreUrl' => route('bulk-delete'),
            'restoreLabel' => 'Restaurar',
            'restoreModalQuestion' =>'¿ Esta seguro que desea restaurar este laboratorio?',

            'perPage' => 10,
            'perPageLabel' => 'Laboratorios por página',
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
        $query = new Laboratory();

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
