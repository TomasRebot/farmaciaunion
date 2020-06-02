<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('panel.partials.router')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ GlobalConfig::bussinesName()}}</title>
        <link rel="icon" type="image/vnd.microsoft.icon" href="{{GlobalConfig::favicon()}}" sizes="228x228">
        <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
        <script src="{{ asset('js/panel.js') }}"></script>
        @yield('custom-styles')
    </head>
    <body>
        <div id="wrapper">
            @yield('application')
        </div>
        @include('panel.alerts.common-alerts')

        @yield('custom-scripts')
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
