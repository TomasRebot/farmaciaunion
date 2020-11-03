@extends('panel.layout.content-panel')
@section('page-name')
    <h3>Nuevo producto</h3>
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('products.store')}}"
                          class="form-horizontal validable "
                          id="createProductsForm"
                          data-handler="default"
                          data-invalidhandler="false"
                          method="POST">
                    @csrf
                        <!--Linea de atributos generales -->
                        <hr>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form-group row @if ($errors->has('bar_code')) has-error @endif">
                                    <label class="control-label " for="bar_code"><b>Código de barras</b></label>
                                    <div class="col-sm-8">
                                        <input id="bar_code" type="text" class="form-control"
                                               value=""
                                               data-rule="bar_code" data-restrictions="required"
                                               name="bar_code">
                                        @error ('bar_code')
                                        <span class="control-label">
                                                    {{ $messages }}
                                                </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row @if ($errors->has('name')) has-error @endif">
                                    <label class="control-label " for="name"><b>Nombre</b></label>
                                    <div class="col-sm-10">
                                        <input id="name" type="text" class="form-control"
                                               data-rule="name" data-restrictions="required"
                                               name="name">
                                        @error ('name')
                                        <span class="control-label">
                                                    {{ $messages }}
                                                </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row @if ($errors->has('presentacion')) has-error @endif">
                                    <label class=" control-label " for="name"><b>Presentacion</b></label>
                                    <div class="col-sm-9">
                                        <input id="name" type="text" class="form-control"
                                            value=""
                                            data-rule="presentation" data-restrictions="required"
                                            name="presentation">
                                        @error ('presentation')
                                            <span class="control-label">
                                                {{ $messages }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row @if ($errors->has('fragment_unit')) has-error @endif">
                                    <label class=" control-label" for="fragment_unit"><b>Cantidad fragmentado</b></label>
                                    <div class="col-sm-8">
                                        <input id="fragment_unit" type="text" class="form-control"
                                               value=""
                                               required
                                               data-rule="fragment_unit" data-restrictions="required"
                                               name="fragment_unit">
                                        @error ('fragment_unit')
                                            <span class="control-label">
                                                {{ $messages }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row @if ($errors->has('die_number')) has-error @endif">
                                    <label class="control-label " for="die_number"><b>Número de troquel</b></label>
                                    <div class="col-sm-8">
                                        <input id="die_number" type="text" class="form-control"
                                               value=""
                                               data-rule="die_number" data-restrictions="required"
                                               name="die_number">
                                        @error ('die_number')
                                            <span class="control-label">
                                                {{ $messages }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row @if ($errors->has('price')) has-error @endif">
                                    <label class=" control-label " for="price"><b>Precio</b> </label>
                                    <div class="col-sm-8">
                                        <input id="price" type="number" min="1" class="form-control"
                                               value=""
                                               data-rule="price" data-restrictions="required"
                                               name="price">
                                        @error ('price')
                                            <span class="control-label">
                                                {{ $messages }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row mt-5" id="create_product_ajax_select_loading" >
                            <div class="sk-spinner sk-spinner-wave">
                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>
                            </div>
                        </div>
                        <!-- selects-->
                        <div  class="opacity-0" id="create_product_ajax_select_container">
                            <div class="row mt-3" >
                                <div class="col-md-4">
                                    <div class="input-group @if ($errors->has('drug_id')) has-error @endif">
                                    <span class="input-group-addon border-0">
                                        <label class=" control-label" for="input-name"><b>Droga</b> </label>
                                    </span>
                                        <select id="drug_select" class="form-control m-b" name="drug_id">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="input-group @if ($errors->has('therpeutic_action_id')) has-error @endif">
                                    <span class="input-group-addon border-0">
                                        <label class=" control-label" for="input-name"><b>Accion terapeutica</b> </label>
                                    </span>
                                        <select id="therapeutic_action_select" class="form-control m-b" name="primary_therapeutic_action_id">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group @if ($errors->has('laboratory_id')) has-error @endif">
                                        <span class="input-group-addon border-0">
                                            <label class=" control-label" for="input-name"><b>Laboratorio</b> </label>
                                        </span>
                                        <select id="laboratory_select" class="form-control m-b" name="laboratory_id">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group @if ($errors->has('brand')) has-error @endif">
                                    <span class="input-group-addon border-0">
                                        <label class=" control-label" for="brands_select"><b>Marca</b> </label>
                                    </span>
                                        <select id="brands_select" class="form-control m-b" name="brand_id">


                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group @if ($errors->has('category_id')) has-error @endif">
                                    <span class="input-group-addon border-0">
                                        <label class=" control-label" for="category_select"><b>Categoría</b> </label>
                                    </span>
                                        <select id="category_select" class="form-control m-b" name="category_id"></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group @if ($errors->has('provider_id')) has-error @endif">
                                    <span class="input-group-addon border-0">
                                        <label class=" control-label" for="provider_select"><b>Proveedor</b> </label>
                                    </span>
                                        <select id="provider_select" class="form-control m-b" name="provider_id"></select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="form-group row @if ($errors->has('description')) has-error @endif">
                                    <label class="control-label col-sm-2 mb-3" for="description"><b>Descripcion</b></label>
                                    <div class="col-sm-8">
                                        <textarea id="description"
                                              data-rule="description" data-restrictions="required"
                                              type="text" class="form-control description"name="description">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- selects-->
                        <div class="row">
                            <div class="col-md-6 mt-4 mb-4">
                                <div class="group">
                                    <span class="group-addon border-0">
                                        <label class=" control-label"><b>Estado</b></label>
                                    </span>
                                    <div class="col-md-3 ">
                                        <div class="i-checks"><label> <input type="radio" value="1" name="state"  checked="true"> <i></i> Activo </label></div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="i-checks"><label> <input type="radio" value="0" name="state" > <i></i> Inactivo </label></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <!--Linea atributos especificos-->

                        <!-- Botones de accion -->
                        <div class="clear"></div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('products.index') }}" class="btn btn-white" type="submit">Cancelar</a>
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
    <script src="{{asset('js/pages/products.js')}}"></script>
@endsection
