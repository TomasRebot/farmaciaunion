<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Mtz') }}</title>
        <link href="{{ asset('css/panel.css') }}" rel="stylesheet">
        <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
        <script src="{{ asset('js/panel.js') }}"></script>

        @yield('custom-styles')
    </head>
    <body class="gray-bg mt-5">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <img src="{{GlobalConfig::loginImage()}}" alt="mtz-logo" class="img-login">
            <form class="m-t" role="form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           placeholder="Email" value={{old('email')}}>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                           placeholder="Nombre"  value={{old('name')}} >
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="Contraseña" >
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                           placeholder="Confirmar contraseña" >
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Registrarse</button>
                <a href="{{route('site')}}" class="btn btn-default block full-width m-b">Volver</a>


            </form>
            <p class="m-t"> <small>{{GlobalConfig::suportContactMail()}}</small> </p>
        </div>
    </body>
</html>


