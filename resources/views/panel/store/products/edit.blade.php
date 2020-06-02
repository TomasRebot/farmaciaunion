@extends('panel.layout.content-panel')
@section('page-name')
    <h3>Editar producto</h3>
@stop
@section('content')
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#general">Datos Generales</a></li>
        </ul>
        <div class="tab-content">
            <div id="general" class="tab-pane active">
                <div class="panel-body" style="padding-top:25px">
                    <form action="{{route('products.update', [$product])}}"
                          class="form-horizontal "
                          method="POST">
                        @csrf
                        @method('PUT')

                        <!--Linea de codigos disableds-->
                        <div class="row mb-3">
                            <div class="col-md-4 mt-3 ">
                                <div class="input-group">
                                    <span class="input-group-addon border-0">
                                        <label class="control-label" for="id"><b>Código Web</b></label>
                                    </span>
                                    <input id="id" type="text" class="form-control" value="{{$product->id}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="input-group">
                                    <span class="input-group-addon border-0">
                                        <label class="control-label" for="input-name"><b>Código Merlin</b></label>
                                    </span>
                                    <input id="input-id_merlin" type="text" class="form-control" value="{{$product->merlin_id ?? 'Solo se vende por web'}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="input-group @if ($errors->has('stock')) has-error @endif">
                                    <span class="input-group-addon border-0">
                                        <label class=" control-label" for="input-name"><b>Stock</b></label>
                                    </span>
                                    <input id="input-name" type="number" class="form-control"
                                           value="{{$product->stock}}"
                                           disabled
                                           name="stock">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--Fin linea de codigos disableds-->
                        <!--Linea de atributos generales -->
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <div class="input-group  @if ($errors->has('bar_code')) has-error @endif">
                                    <span class="input-group-addon border-0">
                                        <label class="control-label" for="input-name"><b>Código de barras</b></label>
                                    </span>
                                    <input id="input-name" type="text" class="form-control"
                                           value="{{$product->bar_code}}"
                                           required
                                           name="name">
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="input-group  @if ($errors->has('name')) has-error @endif">
                                    <span class="input-group-addon border-0">
                                        <label class="control-label" for="input-name"><b>Nombre</b></label>
                                    </span>
                                    <input id="input-name" type="text" class="form-control"
                                           value="{{$product->name}}"
                                           required
                                           name="name">
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="input-group @if ($errors->has('presentacion')) has-error @endif">
                                    <span class="input-group-addon border-0">
                                        <label class=" control-label" for="input-name"><b>Presentacion</b></label>
                                    </span>
                                    <input id="input-name" type="text" class="form-control"
                                           value="{{$product->presentation}}"
                                           required
                                           name="presentation">
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="input-group @if ($errors->has('fragment_unit')) has-error @endif">
                                    <span class="input-group-addon border-0">
                                        <label class=" control-label" for="input-name"><b>Cantidad fragmentado</b></label>
                                    </span>
                                    <input id="input-name" type="text" class="form-control"
                                           value="{{$product->fragment_unit}}"
                                           required
                                           name="fragment_unit">
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="input-group">
                                    <span class="input-group-addon border-0">
                                        <label class="control-label" for="input-name"><b>Número de troquel</b></label>
                                    </span>
                                    <input id="input-die_number" type="text" class="form-control"
                                           value="{{intval($product->die_number)}}"
                                           name="die_number">
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="input-group @if ($errors->has('price')) has-error @endif">
                                    <span class="input-group-addon border-0">
                                        <label class=" control-label" for="price"><b>Precio</b> </label>
                                    </span>
                                    <input id="price" type="float" min="1" class="form-control"
                                           value="{{$product->price}}"
                                           name="price">
                                </div>
                            </div>
                        </div>
                            <div class="row mt-5" id="product_ajax_select_loading">
                                <div class="sk-spinner sk-spinner-wave">
                                    <div class="sk-rect1"></div>
                                    <div class="sk-rect2"></div>
                                    <div class="sk-rect3"></div>
                                    <div class="sk-rect4"></div>
                                    <div class="sk-rect5"></div>
                                </div>
                            </div>

                            <!-- selects-->
                            <div id="product_ajax_select_container" class="opacity-0">
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
                                        <label class="control-label col-sm-2 mb-3" for="input-name"><b>Descripcion</b></label>
                                        <div class="col-sm-8">
                                        <textarea id="input-description"
                                                  type="text" class="form-control"name="description">
                                        {{$product->description }}
                                    </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- selects-->

                        <div class="row">
                            <div class="col-md-6 mt-4 mb-4">
                                <div class="input-group">
                                    <span class="input-group-addon border-0">
                                        <label class=" control-label"><b>Estado</b></label>
                                    </span>
                                    <div class="col-md-3 ">
                                        <div class="i-checks"><label> <input type="radio" value="1" name="state" @if(($product->state)==1) checked="" @endif> <i></i> Activo </label></div>
                                    </div>
                                    <div class="col-md-3 ">
                                        <div class="i-checks"><label> <input type="radio" value="0" name="state" @if(($product->state)==0) checked="" @endif > <i></i> Inactivo </label></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
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
