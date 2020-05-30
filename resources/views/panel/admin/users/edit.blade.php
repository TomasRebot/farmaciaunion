@extends('panel.layout.content-panel')
@section('page-name')
    Editar Usuario
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('users.update',$user)}}"
                          class="form-horizontal offset-1 validable"
                          method="POST"
                          id="editUserForm"
                          data-handler="default"
                          data-invalidhandler="false">
                        @csrf
                        @method('PUT')
                        <div class="form-group row  @error ('name') has-error @enderror">
                            <label class="col-sm-2 control-label" for="name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="name" data-rule="name" data-restrictions="required"
                                       type="text" class="form-control" name="name"
                                       value="{{$user->name}}">
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
                                       data-rule="email" data-restrictions="required:true|email:true"
                                       value="{{$user->email}}">
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
                                <input id="password" type="password" class="form-control"
                                       placeholder="********"
                                       name="password">
                                @error ('password')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('roles')) has-error @endif">
                            <label class="col-sm-2 control-label">Roles<span class="oblig">&nbsp;</span></label>
                            <div class="col-sm-8 offset-2">
                                <div class="row">
                                    @foreach($roles as $role)
                                        <div class="col-sm-6 ">
                                            <label class="checkbox-inline i-checks">
                                                <input type="checkbox"
                                                       @if($user->hasRole($role->name))
                                                       checked
                                                       @endif
                                                       name="roles[]"
                                                       value="{{$role->id}}">
                                                {{$role->name}}
                                            </label>
                                        </div>
                                    @endforeach
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
