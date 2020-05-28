<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php
use App\User;
use App\MaturityLevel;
?>
<head>
    @yield('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> ICA </title>
    <link rel="icon" href="{{ asset('../../favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('../../plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('../../plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('../../plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('../../css/style.css') }}" rel="stylesheet">
</head>
<body class="login-page"> 
                <center>
                    <img src="{{ asset('../../images/ICA.png') }}" style="width:300px;"><br><br>
                </center>
    <div class="login-box">
        <div class="logo">
        </div>
        <div class="card">
            <div class="body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @error('email')
                                <div class="alert alert-success">
                                    <strong>{{ $message }}</strong>
                                </div>
                    @enderror
                    <div class="msg">Para recuperación de contraseña, ingrese su correo para enviar un mensaje para restablecer su contraseña</div>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                         <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">mail</i>
                            </span>
                            <div class="form-line">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electronico">
                            </div>
                    </div>

                        <div class="row clearfix">
                            <div class="col-md-12">
                                <center>
                                    <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar enlace de recuperación de contraseña.') }}
                                </button>
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('../../plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('../../plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('../../plugins/node-waves/waves.js') }}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{ asset('../../plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('../../js/admin.js') }}"></script>
    <script src="{{ asset('../../js/pages/examples/sign-in.js') }}"></script>
</body>


