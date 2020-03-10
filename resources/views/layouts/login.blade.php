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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1fd9851a23.js" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">


    <!-- Styles Views-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    <!-- Styles Login-->
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>
<nav class="navbar navbar-dark" style="background-color:#112d4e;" >
        <a class="navbar-brand" >Inicio</a>
</nav>
<body>

    <div id="grid-item" class="item-p">
        <div class="item" style="grid-column: 1/-1;"> 
            <img src="{{ asset('imagenes/Logo.png') }}" id="logo" class="logo" >
              <h1>Intelligent Capacity Approach</h1>
            <h3>
                Un sistema enfocado a optimizar la gestión de resultados dentro de las empresas.
            </h3>
        </div>  
        <div id="From" style="background-color:#112d4e;grid-column: 1/-1;" >
            <div style="margin: auto;width: 80%;">
             <h4>!! NOTA !!</h4>
             <h5> Rercuerda, que solo se puede inciar seccion y no resgistrase por su propia cuenta. Su CUENTA debe se crear los adminstradores de la compañía correspodiente.</h5> 
            </div>
            <div style="margin: auto;width: 90%;"><br>
                <h4>Iniciar sesión</h4>
                @yield("content")
            </div>
        </div>
    </div>
    <div id="grid-panel">
        <div id="grid-item" class="item-s"> 
            <img src="{{ asset('imagenes/Logosite.png') }}" height="150px">
            <h5>Una aplicación web que permita evaluar el nivel de madurez de las áreas de una compañía</h5>
        </div>
        <div id="grid-item" class="item-s">
            <img src="{{ asset('imagenes/Logocompanyt.png') }}" height="150px">
            <h5>
                Permitir el manejo de las compañías afiliadas al servicio, quienes tendrán la capacidad de crear usuarios, áreas y asignar pruebas para su empresa.
            </h5>
        </div>
        <div id="grid-item" class="item-s">

            <img src="{{ asset('imagenes/Logotest.png') }}" height="150px">
            <h5>
                Las pruebas son evaluadas por medio de evidencias provee y estas son validadas por un analista.
            </h5>
        </div>
    </div>
    
</body>


<script>
var ban = true;
    
 setInterval(function(){ 
    if(ban){
        ban = false;
        $("#logo").addClass("Animacion");
    }else{
        ban = true;
        $("#logo").removeClass("Animacion");
    }
}, 6000);
</script>