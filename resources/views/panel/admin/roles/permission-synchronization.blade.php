@extends('panel.layout.content-panel')
@section('page-name')
    Editar rol: {{$role->name}}
@endsection
@section('content')

<form action="{{route('roles.synchronize', ['roleId' => $role->id])}}"
      class="form-horizontal "
      method="POST">
    @csrf

    <div class="hidden" id="page-loader">
        <span class="preloader-interior"></span>
    </div>

    <input type="text" class="form-control
    searchform col-md-3 pull-right"
           id="filter" placeholder="Buscar...">

    <table class="footable table table-stripped"
           data-page-size="8" data-filter=#filter>
        <thead>
        <tr>
            <th>Formulario</th>
            <th>Módulo</th>
            @foreach($permissions as $permission)
                <th>{{$permission->name}}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($forms as $form)
            <tr>
                <td>
                    <a class="accion">
                        {{$form->name}}
                    </a>
                </td>
                <td>
                    <a class="accion">
                        {{isset($form->module) ? $form->module->name : 'Menu principal'}}
                    </a>
                </td>
                @foreach($permissions as $permission)

                    <td>
                        <div class="i-checks">
                        <div class="icheckbox_square-green " style="position: relative;">
                            <input type="checkbox"
                                   id="permission_id"
                                   @if( $role->roleCan($role->id.'-'.$form->id.'-'.$permission->id))
                                   checked
                                   @endif
                                   name="permissions[]"
                                   value="{{$form->id .'-'.$permission->id}}">
                        </div>
                        </div>
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="12">
                <ul class="pagination pull-right"></ul>
            </td>
        </tr>
        </tfoot>
    </table>
    <div class="clear"></div>
    <div class="form-group row">
        <div class="col-sm-4 col-sm-offset-2">
            <a href="{{ route('roles.index') }}" class="btn btn-white" type="submit">Cancelar</a>
            <button class="btn btn-primary" type="submit">Guardar</button>
        </div>
    </div>
</form>
@endsection

