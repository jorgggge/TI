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
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>ICA</b></a>
            <small></small>
        </div>
        <div class="card">
            <div class="body">
                <div class="alert bg-red">
                               Lo sentimos, su cuenta ha sido deshabilitada, en caso de que se un error comunicase con los encargados de su compañia.
                </div>
            </div>
            <center>
                <button class="btn btn-primary" onclick="window.location = '/login'">
                    Regresar
                </button>
            </center>
            <br><br>
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
