<?php
namespace App\Core\DynamicTableResources;
use App\Core\Entities\BaseTableResource;
use App\Core\Interfaces\ResourceTableInterface;
use App\Entities\Drug;

use Illuminate\Http\Request;

class DrugTableResource extends BaseTableResource implements ResourceTableInterface
{

    public function getResource(){

        return [

            'page_name' => 'Drogas',
            'resource' => 'Drug',
            'resolver' => 'DrugResolver',

            'permissions' => permissionsTo($this->current_form),

            'url' =>route('api.dynamic.table'),
            'createUrl' =>route('drugs.create'),
            'editUrl' => route('drugs.edit', ['drug' => 'Drug']),

            'deleteUrl' => route('bulk-delete'),
            'deleteLabel' => 'Eliminar',
            'deleteModalQuestion' => '¿Esta seguro que desea eliminar esta droga?',

            'restoreUrl' => route('bulk-delete'),
            'restoreLabel' => 'Restaurar',
            'restoreModalQuestion' =>'¿ Esta seguro que desea restaurar esta droga?',

            'perPage' => 10,
            'perPageLabel' => 'Usuarios por página',
            'filters' => ['name', 'therapeutic_action','description'],
            'emptyTableLabel' => 'No se encontraron registros'
        ];
    }

    public function handle(Request $request)
    {
        $columns = collect([
            ["label" => 'Nombre', "field" => 'name', ],
            ["label" => 'Descripcion',"field" => 'description'],
            ["label" => 'Accion terapeutica',"field" => 'therapeutic_action'],
            ["label" => 'Estado',"field" => 'state'],
        ]);


        $query = new Drug();

        $query = $this->filter($query, $request);

        $query = $this->sort($query, $request);

        $data = $query->paginate($request->per_page)->appends(['sort' => $request->sort]);

        $data->each(function($drug){
            $drug['therapeutic_action'] = $drug->therpaeuticActionsToString;
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
                    case'therapeutic_action':
                        $query = $query->orWhereHas('therpaeuticActions', function($theraction)use($request){
                            $theraction->where('name', 'LIKE','%'.$request->search_query.'%');
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
