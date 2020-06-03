<?php
namespace App\Core\DynamicTableResources;
use App\Core\Entities\BaseTableResource;
use App\Core\Interfaces\ResourceTableInterface;
use App\Entities\Client;
use App\Entities\User;
use Illuminate\Http\Request;

class ActiveClientTableResource extends BaseTableResource implements ResourceTableInterface
{

    public function getResource(){
        return [
            'resource' => 'Client',
            'resolver' => 'ActiveClients',
            'permissions' => permissionsTo($this->current_form),

            'url' =>route('api.dynamic.table'),
            'createUrl' =>route('clients.create'),
            'editUrl' => route('clients.edit', ['client' => 'Client']),

            'deleteUrl' => route('bulk-delete'),
            'deleteLabel' => 'Suspender',
            'deleteModalQuestion' => '¿Esta seguro que desea suspender este cliente?',

            'restoreUrl' => null,
            'restoreLabel' => null,
            'restoreModalQuestion' =>null,

            'perPage' => 10,
            'perPageLabel' => 'Clientes por página',
            'filters' => ['name', 'email'],
            'emptyTableLabel' => 'No se encontraron registros'
        ];
    }

    public function handle(Request $request)
    {
        $columns = collect([
            ["label" => 'Nombre', "field" => 'name', ],
            ["label" => 'Email',"field" => 'email'],
            ["label" => 'Estado',"field" => 'state'],
        ]);
        $query = new Client();

        $query = $this->filter($query,$request)->activeClients();

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
