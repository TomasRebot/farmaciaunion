@extends('layouts.content-panel')
@section('page-name')
    Solicitudes de clientes
@endsection
@section('content')
    @create('clients')
    <a href="{{ route('clients.create') }}"
       class="btn btn-primary">Nuevo
    </a>
    @endcreate
    @delete('clients')
    <button data-placement="bottom"
            title="Borrar"
            type="button"
            class="btn btn-danger accion"
            data-action="show">
        Eliminar
    </button>
    @enddelete

    <div class="hidden" id="page-loader">
        <span class="preloader-interior"></span>
    </div>

    <input type="text" class="form-control
    searchform col-md-3 pull-right"
           id="filter" placeholder="Buscar...">

    <table class="footable table table-stripped"
           data-page-size="8" data-filter=#filter >
        <thead>
        <tr>
            <td class="check-mail">
                <input type="checkbox" class="i-checks todo">
            </td>
            <th>Nombre</th>
            <th>Email</th>
            <th class="pull-right">Estado</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clients as $client)
        <tr>
            <td valign="top" class="check-mail">
                <input type="checkbox"
                       class="i-checks"
                       value="{{$client->id}}"
                       name="ids[]">
            </td>
           <td>
               <a class="accion"
                  @update('clients') href="{{route('clients.edit', ['id'=>$client->id])}}" @endif >
                   {{$client->name}}
               </a>
           </td>
            <td>
                <a class="accion"
                   @update('clients')href="{{route('clients.edit', ['id'=>$client->id])}}" @endif >
                    {{$client->email}}
                </a>
            </td>
            <td>
                <a href="{{route('clients.edit', [$client->id])}}" class="accion">

                    @if(($client->state)==0)
                        <span class="label label-danger pull-right">Inactivo</span>
                    @else
                        <span class="label label-primary pull-right">Activo</span>
                    @endif
                </a>
            </td>
        </tr>
            @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="6">
            <ul class="pagination pull-right"></ul>
        </td>
    </tr>
    </tfoot>
    </table>
    @component('backend.modals.sure-delete')
        @slot('modelToDelete')
            deleteUser
        @endslot
        @slot('question')
            ¿Esta seguro de eliminar este usuario?
        @endslot
    @endcomponent

@endsection

@section('custom-scripts')
    <script>
        const bulkConfig = {
            'model': 'user',
            'soft':true,
            'modalName':'deleteUser'
        }
    </script>
    <script src="{{asset('js/requests/bulk-delete.js')}}"></script>
@endsection
