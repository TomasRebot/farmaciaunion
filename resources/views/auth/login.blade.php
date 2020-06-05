<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Farmacia union') }}</title>
        <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
        <script src="{{ asset('js/panel.js') }}"></script>

        @yield('custom-styles')
    </head>
    <body class="gray-bg mt-5">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <img src="{{GlobalConfig::loginImage()}}" alt="mtz-logo" class="img-login">
            <form class="m-t validable"
                role="form" method="POST" action="{{ route('login') }}"
                id="createFormsForm"
                data-handler="default"
                data-invalidhandler="false">
                @csrf
                <div class="form-group">
                    <input
                        data-rule="email" data-restrictions="required:true|email:true"
                        type="email" name="email" class="form-control" placeholder="Usuario" >
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña"
                           data-rule="password" data-restrictions="required:true|minlength:6"
                    >
                </div>

                <div class="form-group">
                    <label>
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        Recordarme
                    </label>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                <a href="{{route('site')}}" class="btn btn-default block full-width m-b">Volver</a>
                <a  href="{{ route('password.request') }}"><small>Olvido su contraseña?</small></a>
            </form>
            <p class="m-t"> <small>{{GlobalConfig::suportContactMail()}}</small> </p>

    </div>
    </body>
</html>




