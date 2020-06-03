<?php
namespace App\Core\DynamicTableResources;
use App\Core\Entities\BaseTableResource;
use App\Core\Interfaces\ResourceTableInterface;
use App\Entities\Client;

use Illuminate\Http\Request;

class UnactiveClientTableResource  extends BaseTableResource implements ResourceTableInterface
{

    public function getResource(){
        return [
            'resource' => 'Client',
            'resolver' => 'UnactiveClients',

            'url' =>route('api.dynamic.table'),
            'createUrl' => null,
            'editUrl' => route('clients.edit', ['client' => 'Client']),
            'permissions' => permissionsTo($this->current_form),
            'deleteUrl' => null,
            'deleteLabel' => null,
            'deleteModalQuestion' => null,

            'restoreUrl' => route('bulk-delete'),
            'restoreLabel' => 'Restaurar',
            'restoreModalQuestion' => '¿Esta seguro que desea restarurar este cliente?',

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

        $query = $this->filter($query,$request)->unactiveClients();

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
