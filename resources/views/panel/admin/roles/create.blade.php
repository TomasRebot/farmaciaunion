@extends('panel.layout.content-panel')
@section('page-name')
    Nuevo Rol
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('roles.store')}}"
                        class="form-horizontal offset-1 validable"
                        method="post"
                        id="createRolesForm"
                        data-handler="default"
                        data-invalidhandler="false">
                        @csrf
                        <div class="form-group row  @error('name') has-error @enderror">
                            <label class="col-sm-2 control-label" for="name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="name"
                                       data-rule="name" data-restrictions="required"
                                       type="text" class="form-control" name="name">
                                @error ('name')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error ('description') has-error @enderror">
                            <label class="col-sm-2 control-label" for="description">Descripción <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="description" type="text" class="form-control" name="description"
                                       data-rule="description" data-restrictions="required">
                                @error ('description')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <!-- Botones de accion -->
                        <div class="clear"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('roles.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
