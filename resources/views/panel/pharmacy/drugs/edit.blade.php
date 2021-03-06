@extends('panel.layout.content-panel')
@section('page-name')
    Editar droga / principio activo
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('drugs.update', [$drug])}}"
                          class="form-horizontal offset-1"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row  @if ($errors->has('name')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" type="text" class="form-control"
                                       value="{{$drug->name}}"
                                       name="name">
                            </div>
                        </div>
                        <div class="form-group row @if ($errors->has('description')) has-error @endif">
                            <label class="col-sm-2 control-label" for="input-email">Descripcion <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-email" type="text" class="form-control"
                                       value="{{$drug->description}}"
                                       name="description">
                            </div>
                        </div>

                        <div class="form-group row @if ($errors->has('therpeutic_action_id')) has-error @endif">
                            <label class="col-sm-2 control-label" for="description">Accion terapeutica</label>
                            <div class="col-sm-7">
                                <select id="drug_therapeutic_action_select" class="form-control m-b" name="primary_therapeutic_action_id">

                                </select>
                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-primary" id="add_therapeutic_action"><i class="fa fa-plus"></i></button>
                                <button class="btn btn-danger hidden" id="hide_add_button"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="form-group row hidden" id="new_therapeutic_action_wrapper">
                            <label class="control-label" for="input-name">Nueva accion terapeutica</label>
                            <div class="col-sm-7">
                                <input id="new_therapeutic_action_field" type="text" class="form-control"
                                       value="">
                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-primary" id="save_therapeutic_action"><i class="fa fa-save"></i></button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Estado</label>
                            <div class="col-sm-3">

                                <div class="i-checks"><label> <input type="radio" value="1" name="state" @if(($drug->state)==1) checked="" @endif> <i></i> Activo </label></div>
                            </div>
                            <div class="col-sm-3">
                                <div class="i-checks"><label> <input type="radio" value="0" name="state" @if(($drug->state)==0) checked="" @endif > <i></i> Inactivo </label></div>
                            </div>
                        </div>

                        <!-- Botones de accion -->
                        <div class="clear"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('drugs.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    <script src="{{asset('js/pages/drug_therapeutic_actions.js')}}"></script>
@endsection
