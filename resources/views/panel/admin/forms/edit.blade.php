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
                    <form action="{{route('forms.update', $form)}}"
                          class="form-horizontal offset-1 validable"
                          method="POST"
                          id="editFormsForm"
                          data-handler="default"
                          data-invalidhandler="false">
                        @csrf
                       @method('PUT')
                        <div class="form-group row @error('name') has-error @enderror">
                            <label class="col-sm-2 control-label" for="input-name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="input-name" type="text" class="form-control"
                                       value="{{$form->name}}"
                                       data-rule="name" data-restrictions="required"
                                       name="name">
                                @error ('name')
                                <span class="control-label">
                                        {{ $messages }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row @error('key') has-error @enderror">
                            <label class="col-sm-2 control-label" for="key">Clave <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="key" type="text" class="form-control"
                                       value="{{$form->key}}"
                                       name="key"
                                       data-rule="key" data-restrictions="required">
                                @error ('key')
                                <span class="control-label">
                                        {{ $messages }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row @error('target') has-error @enderror">
                            <label class="col-sm-2 control-label" for="target">Target / Ruta / Url <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="target" type="text" class="form-control"
                                       value="{{$form->target}}"
                                       name="target"
                                       data-rule="target" data-restrictions="required">
                                @error ('target')
                                <span class="control-label">
                                        {{ $messages }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error('module_id') has-error @enderror">
                            <label class="col-sm-2 control-label" for="module_id">Mòdulo </label>
                            <div class="col-sm-8">
                                <select class="form-control m-b" id="module_id" name="module_id">
                                    <option value="">Menu Lateral</option>
                                    @foreach($modules as $module)
                                        <option
                                            name="module_id"
                                            @if($form->module_id === $module->id)
                                                selected
                                            @endif
                                            value="{{$module->id}}">
                                            {{$module->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error ('module_id')
                                <span class="control-label">
                                        {{ $messages }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row @error('order') has-error @enderror">
                            <label class="col-sm-2 control-label" for="order">Órden</label>
                            <div class="col-sm-8">
                                <select id="order" class="form-control m-b" name="order">

                                    @for($i = 1; $i <= $limit; $i++)
                                        <option
                                            name="order"
                                            @if($form->order === $i)
                                                selected
                                            @endif
                                            value="{{$i}}">
                                            {{$i}}
                                        </option>
                                    @endfor
                                </select>
                                @error ('order')
                                <span class="control-label">
                                        {{ $messages }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row @error('icon') has-error @enderror">
                            <label class="col-sm-2 control-label" for="input-email">Ícono </label>
                            <div class="col-sm-6">
                                <input id="input-email" type="text" class="form-control"
                                       value="{{$form->icon}}"
                                       name="icon">
                                @error ('icon')
                                <span class="control-label">
                                        {{ $messages }}
                                    </span>
                                @enderror
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
                            <label class="col-sm-2 control-label">Estado</label>
                            <div class="col-sm-3">
                                <div class="i-checks">
                                    <label>
                                        <input type="radio" value="1" name="state" checked="checked">
                                        Activo
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="i-checks">
                                    <label>
                                        <input type="radio" value="0" name="state">
                                        inactivo
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de accion -->
                        <div class="clear"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('forms.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
