@extends('panel.layout.content-panel')
@section('page-name')
    Nuevo Módulo
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('modules.store')}}"
                        class="form-horizontal offset-1 validable"
                        method="post"
                        id="createRolesForm"
                        data-handler="default"
                        data-invalidhandler="false">
                        @csrf
                        <div class="form-group row  @error('name') has-error @enderror">
                            <label class="col-sm-2 control-label" for="name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="name" type="text" class="form-control"
                                       value=""
                                       name="name"
                                       data-rule="name" data-restrictions="required">
                                @error ('name')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row @error('description') has-error @enderror">
                            <label class="col-sm-2 control-label" for="description">Descripción <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="description" type="text" class="form-control"
                                       value=""
                                       name="description"
                                       data-rule="description" data-restrictions="required">
                                @error ('description')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error('internl_handler') has-error @endif">
                            <label class="col-sm-2 control-label" for="internl_handler">Relación interna <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="internl_handler" type="text" class="form-control"
                                       value=""
                                       name="internal_handler"
                                       data-rule="internal_handler" data-restrictions="required">
                            </div>
                        </div>
                        <div class="form-group row @error('order') has-error @enderror">
                            <label class="col-sm-2 control-label" for="module_order_select">Órden</label>
                            <div class="col-sm-8">
                                <select class="form-control m-b" id="module_order_select" name="order">
                                    @for($i = 0; $i <= $limit; $i++)
                                        <option
                                            name="order"
                                            value="{{$i}}">
                                            {{$i}}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group row @error('icon') has-error @enderror">
                            <label class="col-sm-2 control-label" for="input-email">Ícono</label>
                            <div class="col-sm-6">
                                <input id="icon" type="text" class="form-control"
                                       value=""
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
                        <div class="form-group row">
                            <label class="col-sm-2 control-label" for="state">Estado</label>
                            <div class="col-sm-3">
                                <div class="i-checks"><label> <input type="radio" value="1" name="state" checked="checked" > <i></i> Activo </label></div>
                            </div>
                            <div class="col-sm-3">
                                <div class="i-checks"><label> <input type="radio" value="0" name="state" > <i></i> Inactivo </label></div>
                            </div>
                        </div>
                        <!-- Botones de accion -->
                        <div class="clear"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('modules.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
