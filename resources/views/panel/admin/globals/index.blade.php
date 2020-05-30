@extends('panel.layout.content-panel')
@section('page-name')
    Editar configuracion global
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('global-config.update', $globalConfig)}}"
                          class="form-horizontal offset-1 validable"
                          method="POST"
                          id="globalConfigForm"
                          data-handler="default"
                          data-invalidhandler="false">
                        @csrf
                       @method('PUT')
                        <div class="form-group row  @error('bussines_name') has-error @enderror">
                            <label class="col-sm-2 control-label" for="bussines_name">Nombre <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input id="bussines_name" type="text" class="form-control"
                                       value="{{$globalConfig->bussines_name}}"
                                       name="bussines_name"
                                       data-rule="bussines_name" data-restrictions="required">
                                @error ('bussines_name')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row  @error('bussines_description') has-error @enderror">
                            <label class="col-sm-2 control-label" for="bussines_description">Descripción <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <textarea id="bussines_description" type="text" class="form-control"
                                       name="bussines_description"
                                       data-rule="bussines_description" data-restrictions="required">
                                    {{$globalConfig->bussines_description}}
                                </textarea>
                                @error ('bussines_description')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row  @error('whatsapp_phone') has-error @enderror">
                            <label class="col-sm-2 control-label" for="whatsapp_phone">Whatsapp</label>
                            <div class="col-sm-8">
                                <input id="whatsapp_phone" type="text" class="form-control"
                                       value="{{$globalConfig->whatsapp_phone}}"
                                       name="whatsapp_phone"
                                       data-rule="whatsapp_phone" data-restrictions="required">
                                @error ('whatsapp_phone')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row  @error('schedule_time') has-error @enderror">
                            <label class="col-sm-2 control-label" for="schedule_time">Horarios</label>
                            <div class="col-sm-8">
                                <input id="schedule_time" type="text" class="form-control"
                                       value="{{$globalConfig->schedule_time}}"
                                       name="schedule_time"
                                       data-rule="schedule_time" data-restrictions="required">
                                @error ('schedule_time')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row  @error('fix_phone') has-error @enderror">
                            <label class="col-sm-2 control-label" for="fix_phone">Telefono fijo</label>
                            <div class="col-sm-8">
                                <input id="fix_phone" type="text" class="form-control"
                                       value="{{$globalConfig->fix_phone}}"
                                       name="fix_phone"
                                       data-rule="fix_phone" data-restrictions="required">
                                @error ('fix_phone')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>





                        <div class="form-group row  @error('pixel_facebook') has-error @enderror">
                            <label class="col-sm-2 control-label" for="pixel_facebook">Pixel facebook</label>
                            <div class="col-sm-8">
                                <input id="pixel_facebook" type="text" class="form-control"
                                       value="{{$globalConfig->pixel_facebook}}"
                                       name="pixel_facebook"
                                       data-rule="pixel_facebook" data-restrictions="required">
                                @error ('pixel_facebook')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row  @error('google_analitycs') has-error @enderror">
                            <label class="col-sm-2 control-label" for="google_analitycs">Google Analytics</label>
                            <div class="col-sm-8">
                                <textarea id="google_analitycs" type="text" class="form-control"
                                       name="google_analitycs"
                                       data-rule="google_analitycs" data-restrictions="required">
                                    {{$globalConfig->google_analitycs}}
                                </textarea>

                                @error ('google_analitycs')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row  @error('facebook_link') has-error @enderror">
                            <label class="col-sm-2 control-label" for="facebook_link">Link facebook</label>
                            <div class="col-sm-8">
                                <input id="facebook_link" type="text" class="form-control"
                                       value="{{$globalConfig->facebook_link}}"
                                       name="facebook_link"
                                       data-rule="facebook_link" data-restrictions="required:true|url:true">
                                @error ('facebook_link')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row  @error('instagram_link') has-error @enderror">
                            <label class="col-sm-2 control-label" for="instagram_link">Link facebook</label>
                            <div class="col-sm-8">
                                <input id="instagram_link" type="text" class="form-control"
                                       value="{{$globalConfig->instagram_link}}"
                                       name="instagram_link"
                                       data-rule="instagram_link" data-restrictions="required:true|url:true">
                                @error ('instagram_link')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row  @error('twitter_link') has-error @enderror">
                            <label class="col-sm-2 control-label" for="twitter_link">Link twitter</label>
                            <div class="col-sm-8">
                                <input id="twitter_link" type="text" class="form-control"
                                       value="{{$globalConfig->twitter_link}}"
                                       name="twitter_link"
                                       data-rule="twitter_link" data-restrictions="required:true|url:true">
                                @error ('twitter_link')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row  @error('youtube_link') has-error @enderror">
                            <label class="col-sm-2 control-label" for="youtube_link">Link youtube</label>
                            <div class="col-sm-8">
                                <input id="youtube_link" type="text" class="form-control"
                                       value="{{$globalConfig->youtube_link}}"
                                       name="youtube_link"
                                       data-rule="youtube_link" data-restrictions="required:true|url:true">
                                @error ('youtube_link')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row  @error('linkedin_link') has-error @enderror">
                            <label class="col-sm-2 control-label" for="linkedin_link">Linkedin</label>
                            <div class="col-sm-8">
                                <input id="linkedin_link" type="text" class="form-control"
                                       value="{{$globalConfig->linkedin_link}}"
                                       name="linkedin_link"
                                       data-rule="linkedin_link" data-restrictions="required:true|url:true">
                                @error ('linkedin_link')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row  @error('data_fiscal_link') has-error @enderror">
                            <label class="col-sm-2 control-label" for="data_fiscal_link">Link data fiscal</label>
                            <div class="col-sm-8">
                                <input id="data_fiscal_link" type="text" class="form-control"
                                       value="{{$globalConfig->data_fiscal_link}}"
                                       name="data_fiscal_link"
                                       data-rule="data_fiscal_link" data-restrictions="required:true|url:true">
                                @error ('data_fiscal_link')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row  @error('email_sender') has-error @enderror">
                            <label class="col-sm-2 control-label" for="email_sender">Direccion para enviar email</label>
                            <div class="col-sm-8">
                                <input id="email_sender" type="text" class="form-control"
                                       value="{{$globalConfig->email_sender}}"
                                       name="email_sender"
                                       data-rule="email_sender" data-restrictions="required:true|email:true">
                                @error ('email_sender')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row  @error('email_reciver') has-error @enderror">
                            <label class="col-sm-2 control-label" for="email_reciver">Direccion para recibir email</label>
                            <div class="col-sm-8">
                                <input id="email_reciver" type="text" class="form-control"
                                       value="{{$globalConfig->email_reciver}}"
                                       name="email_reciver"
                                       data-rule="email_reciver" data-restrictions="required:true|email:true">
                                @error ('email_reciver')
                                <span class="control-label">
                                        <p>{{ $messages }}</p>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row  @error('email_suport') has-error @enderror">
                            <label class="col-sm-2 control-label" for="email_suport">Email soporte</label>
                            <div class="col-sm-8">
                                <input id="email_suport" type="text" class="form-control"
                                       value="{{$globalConfig->email_suport}}"
                                       name="email_suport"
                                       data-rule="email_suport" data-restrictions="required:true|email:true">
                                @error ('email_suport')
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
                                <a href="{{ route('home') }}" class="btn btn-white" type="submit">Cancelar</a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
