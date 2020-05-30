@extends('panel.layout.content-panel')
@section('page-name')
    Editar Formulario
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('permissions.update', $permission)}}"
                          class="form-horizontal offset-1 validable"
                          method="POST"
                          id="editPermissionsForm"
                          data-handler="default"
                          data-invalidhandler="false">
                        @csrf
                       @method('PUT')
                        <div class="form-group row  @error('name') has-error @enderror">
                            <label class="col-sm-2 control-label" for="name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="name" type="text" class="form-control"
                                       value="{{$permission->name}}"
                                       name="name"
                                       data-rule="name" data-restrictions="required">
                                @error('name')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row @error ('description') has-error @enderror">
                            <label class="col-sm-2 control-label" for="description">Descripción <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="description" type="text" class="form-control"
                                       value="{{$permission->description}}"
                                       name="description"
                                       data-rule="description" data-restrictions="required">
                                @error('description')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error('action') has-error @enderror">
                            <label class="col-sm-2 control-label" for="action">Acción <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="action" type="text" class="form-control"
                                       value="{{$permission->action}}"
                                       name="action"
                                       data-rule="action" data-restrictions="required">
                                @error('action')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('icon')) has-error @endif">
                            <label class="col-sm-2 control-label" for="icon">Ícono</label>
                            <div class="col-sm-8">
                                <input id="icon" type="text" class="form-control"
                                       value="{{$permission->icon}}"
                                       name="icon">
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-primary dim"
                                        onclick="window.open('https://fontawesome.com/v4.7.0/icons/')"
                                        type="button">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Botones de accion -->
                        <div class="clear"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('permissions.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
