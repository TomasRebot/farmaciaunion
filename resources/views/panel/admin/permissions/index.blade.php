@extends('panel.layout.content-panel')
@section('page-name')
    Usuarios
@endsection
@section('content')
    <div class="hidden" id="page-loader">
        <span class="preloader-interior"></span>
    </div>
    <div class="div">
        <dynamic-table :api-resource="{{ json_encode($apiResource) }}" ></dynamic-table>
    </div>
@endsection
