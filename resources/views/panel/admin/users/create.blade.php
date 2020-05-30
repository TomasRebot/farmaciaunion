@extends('panel.layout.content-panel')
@section('page-name')
    Nuevo Usuario
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('users.store')}}"
                        class="form-horizontal offset-1 validable"
                        method="post"
                        id="createUserForm"
                        data-handler="default"
                        data-invalidhandler="false">
                        @csrf
                        <div class="form-group row  @error ('name') has-error @enderror">
                            <label class="col-sm-2 control-label" for="name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="name" data-rule="name" data-restrictions="required"  type="text" class="form-control" name="name">
                                @error ('name')
                                    <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row @error ('email') has-error @enderror">
                            <label class="col-sm-2 control-label" for="email">Email <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="email" type="text" class="form-control" name="email"
                                       data-rule="email" data-restrictions="required:true|email:true">
                                @error ('email')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error ('password') has-error @enderror">
                            <label class="col-sm-2 control-label" for="password">Password <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="password" type="password" class="form-control" name="password"
                                       data-rule="password" data-restrictions="required">
                                @error ('password')
                                    <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row @error('roles') has-error @enderror">
                            <label class="col-sm-2 control-label" for="roles[]">Roles <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                @foreach($roles as $role)
                                    <label class="checkbox-inline i-checks mr-5">
                                        <input type="checkbox"  id="roles" name="roles[]"
                                               value="{{$role->id}}">
                                        {{$role->name}}
                                    </label>
                                @endforeach
                                @error ('roles')
                                    <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
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
                                <a href="{{ route('users.index') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
