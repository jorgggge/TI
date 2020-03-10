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

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ICA') }}</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('js/customer.js') }}" defer></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1fd9851a23.js" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    {{--Required for Charts--}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Admin.css') }}" rel="stylesheet">

    {{--Required for TableScrolling--}}
    <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css"/>
    <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>

    {{--Required per Vue.js / Vuetify--}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Admin.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('js/code.js') }}" defer></script>

</head>
<body onresize="CambioPantalla();" id="_body" onload="CambioPantalla()"> 
    @if(Auth::user()->hasRole('superadmin'))
    <div style="width: 100%;" id="grid-naveg">
            <div style="background-color: #343a40;color: white;">
                <center><img src="{{ asset('imagenes/Logo.png') }}" style="width: 50%;">
                    <h5>Intelligent Capacity Approach</h5>
                    <hr style="width: 80%;background-color: white;">
                </center>
                <nav class="navbar bg-dark" style="width: 80%;">
                  <ul class="navbar-nav" style="margin: auto;">
                    <li class="nav-item">
                      <a class="navbar-brand" href="{{ url('/superAdmin' ) }}"> 
                        <img src="{{ asset('imagenes/inicio.png') }}" height="30px">        Inicio
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="navbar-brand" href="{{ url('/superAdmin/viewCompanies/create' ) }}"> 
                        <img src="{{ asset('imagenes/empresa.png') }}" height="30px">        Compañias
                      </a>
                    </li>
                    <li class="nav-item">
                       <a class="navbar-brand" href="{{ url('/superAdmin' ) }}"> 
                        <img src="{{ asset('imagenes/admistrador.png') }}" height="30px">        Administradores
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="navbar-brand" href="{{ url('/superAdmin' ) }}"> 
                        <img src="{{ asset('imagenes/historial.png') }}" height="30px">        Historial
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="navbar-brand" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">   
                        <img src="{{ asset('imagenes/salir.png') }}" height="30px">        Salir
                      </a>
                    </li>
                  </ul>
                </nav>
            </div>
            <div>
                <nav class="navbar navbar-expand-sm " style="background-color: #112d4e;">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="navbar-brand" href="{{ url('/superAdmin') }}" style="color:white;" >Super Administrador {{ Auth::user()->username }}</a>
                    </li>
                  </ul>
                </nav>
                    <div style="overflow: scroll;" id="contenido">
                        @yield('content')
                    </div>  
            </div>

    </div>
    @endif

    @if(Auth::user()->hasRole('admin'))
    <div style="width: 100%;" id="grid-naveg">
            <div style="background-color: #343a40;color: white;">
                <center><img src="{{ asset('imagenes/Logo.png') }}" style="width: 50%;">
                    <h5>Intelligent Capacity Approach</h5>
                    <hr style="width: 80%;background-color: white;">
                </center>
                <nav class="navbar bg-dark" style="width: 80%;">
                  <ul class="navbar-nav" style="margin: auto;">
                    <li class="nav-item">
                      <a class="navbar-brand" href="{{ url('/admin') }}"> 
                        <img src="{{ asset('imagenes/inicio.png') }}" height="30px">        Inicio
                      </a>
                    </li>
                    
                    <li class="nav-item">
                      <a class="navbar-brand" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">   
                        <img src="{{ asset('imagenes/salir.png') }}" height="30px">        Salir
                      </a>
                    </li>
                  </ul>
                </nav>
            </div>
            <div>
                <nav class="navbar navbar-expand-sm " style="background-color: #112d4e;">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="navbar-brand" href="{{ url('/admin') }}" style="color:white;" >Administrador {{ Auth::user()->username }}</a>
                    </li>
                  </ul>
                </nav>
                    <div style="overflow: scroll;" id="contenido">
                        @yield('content')
                    </div>  
            </div>

    </div>
    @endif
    
    @yield('script')
    <form id="logout-form" action="{{ route('logout') }}" method="POST"
          style="display: none;">
        @csrf
    </form>

<script type="text/javascript">
    function CambioPantalla() {
        var h = window.innerHeight
        document.getElementById('grid-naveg').style.height = h+"px";
        document.getElementById('contenido').style.height = (h-50)+"px";
    }

</script>
</body>
</html>
