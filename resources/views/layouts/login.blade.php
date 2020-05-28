<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php
use App\User;
use App\MaturityLevel;
?>
<head>
<style type="text/css">
    p{
        color: black;
        text-align: justify;
    }
</style>
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
<body>
            <div class="alert" style="background: #112d4e;">  
                <h6>ICA (Intelligent Capacity Approach)</h6>
            </div>
                <center>
                    <img src="{{ asset('../../images/ICA.png') }}" style="width:300px;"><br><br>
                </center>
            
<div class="container-fluid" style="background: #112d4e;">
    <br>
    <div class="row clearfix" style="height: 300px;">
        
        <div class="col-sm-12" >
        <center>
            <div class="card" style="width: 350px;">
                <div class="body" >
                    @yield("content")
                </div>
            </div></center>
        </div>
    </div>
    <br><br>
    <div class="row clearfix" style="height: 300px;">
        <div class="col-sm-12">   
            <div style="height: 310px; background: white;">
                    <div class="alert" style="background:white;" >
                        
                    <p class="lead">
                        <b>ICA (Intelligent Capacity Approach).</b> <br><br>
                        Permita evaluar el nivel de madurez de las áreas de una compañía. La aplicación tiene que permitir el manejo de las compañías afiliadas al servicio, a tales compañías se les asigna uno o varios administradores, quienes tendrán la capacidad de crear usuarios, áreas y asignar pruebas para su empresa. Las pruebas son evaluadas por medio de evidencias digitales (fotos, documentos) que un usuario común provee y estas son validadas por usuarios analistas.
                    </p>
                    </div>
                </div>
        </div>

    </div><br>
    <div class="row clearfix" style="height: 300px;">
      
        <div class="col-sm-12">
            <div class="card">
                
                    <div class="alert" style="background:white;" >
                        <p class="lead" style="text-align: justify;">
                        <b>Servicio de Evaluación</b>
                    </p>
                    <p>
                        Permite el manejo de las compañías afiliadas al servicio, quienes tendrán la capacidad de asignar usuarios y áreas de sus compañías con respectivas evaluaciones. 
                    </p>
                    </div>
                    <div class="body" style="height: 300px;background-image: url('{{ asset('../../images/servicio.jpg') }}');background-position: center center; background-repeat: no-repeat;background-attachment: fixed;background-size: cover;" >
                </div>
            </div>
        </div>
    </div><br><br>
    <div class="row clearfix" style="height: 300px;">
        
        <div class="col-sm-12">
            <div class="card">
                
                    <div class="alert" style="background:white;" >
                        <p class="lead" style="text-align: justify;">
                        <b>Aplicación web</b>
                    </p>
                    <p >
                        Una aplicación web que permite evaluar el nivel de madurez de las áreas de un compañía.
                    </p>
                    </div>
                    <div class="body" style="height: 300px;background-image: url('{{ asset('../../images/movil.jpg') }}');background-position: center center; background-repeat: no-repeat;background-attachment: fixed;background-size: cover;" >
                </div>
            </div>
        </div>

    </div><br><br>
    <div class="row clearfix" style="height: 300px;">
        
        <div class="col-sm-12" >
            <div class="card">
                
                    <div class="alert" style="background:white;" >
                        
                    <p class="lead">
                      <b>  Sistema de Evaluación</b>
                    </p>
                    <p>
                        Las pruebas son evaluadas por medio de evidencias que provee los usuarios y son validadas según los criterios de los analistas.
                    </p>
                    </div>
                    <div class="body" style="height: 300px;background-image: url('{{ asset('../../images/pruebas.jpg') }}');background-position: center center; background-repeat: no-repeat;background-attachment: fixed;background-size: cover;">
                </div>
            </div>
        </div>

    </div>
    <br>
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
