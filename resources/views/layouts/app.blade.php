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
    <link href="{{ asset('bts4/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('bts4/css/layout.css') }}" rel="stylesheet">

    {{--Required for TableScrolling--}}
    <link rel="stylesheet" href="https://unpkg.com/simplebar@latest/dist/simplebar.css"/>
    <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>

    {{--Required per Vue.js / Vuetify--}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<div class="navbar-ica bg-ica">
    @if(Auth::user()->hasRole('superadmin'))
                <a class="navbar-brand ml-auto" href="{{ url('/superAdmin') }}">
                    @elseif(Auth::user()->hasRole('admin'))
                        <a class="navbar-brand" href="{{ url('/admin') }}">
                            @elseif(Auth::user()->hasRole('analista'))
                                <a class="navbar-brand" href="{{ url('/analista') }}">
                                    @elseif(Auth::user()->hasRole('comun'))
                                        <a class="navbar-brand" href="{{ url('/comun') }}">
                                            @endif
                                            @if(Auth::user()->hasRole('superadmin'))
                                                <i class="material-icons" style="    vertical-align: bottom;">person</i>
                                                <h6>Super Administrador {{ Auth::user()->username }}</h6>
                                            @elseif (Auth::user()->hasRole('admin'))
                                                <i class="material-icons" style="    vertical-align: bottom;">person</i>
                                                <h6>Administrador {{ Auth::user()->username }}</h6>
                                            @elseif (Auth::user()->hasRole('analista'))
                                                <i class="material-icons" style="    vertical-align: bottom;">person</i>
                                                <h6>Analista {{ Auth::user()->username }}</h6>
                                            @elseif (Auth::user()->hasRole('comun'))
                                                <i class="material-icons" style="    vertical-align: bottom;">person</i>
                                                <h6>Usuario {{ Auth::user()->username }}</h6>
                                            @endif
                                        </a>
                                </a>
                        </a>
                </a>
</div>
<div class="sidebar">
    @auth
        <form id="logout-form" action="{{ route('logout') }}" method="POST"
              style="display: none;">
            @csrf
        </form>
    <!-- ROUTES FOR SUPERADMIN -->
        @if(Auth::user()->hasRole('superadmin'))
            <a class="" href="{{ url('/superAdmin') }}"><i class="material-icons" style="vertical-align: bottom;">
                    dashboard
                </i> Inicio</a>
            <a class="" href="{{ url('CreateCompany/addCompany/create') }}"><i class="material-icons" style="vertical-align: bottom;">
                    business
                </i> Añadir Compañia</a>
            <a class="" href="{{ url('CreateAdmin/addAdmin/create' ) }}"><i class="material-icons" style="vertical-align: bottom;">
                    person_add
                </i> Administrador</a>
            <a class="" href="{{ url('/superAdmin/viewCompanies/create') }}"><i class="material-icons" style="vertical-align: bottom;">
                    remove_red_eye
                </i> Ver Compañías</a>
            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="material-icons" style="vertical-align: bottom;">
                    power_settings_new
                </i> {{ __('Salir') }}
            </a>

            <!-- ROUTES FOR ADMIN -->
        @elseif(Auth::user()->hasRole('admin'))
            <?php
            $user = auth()->user();
            $userId = $user->companyId;
            $admins = User::all();
            $CountMaturity = MaturityLevel::where('companyId', '=', $userId)->count();
            if ($CountMaturity == 0) { ?>
            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                {{ __('Salir') }}
            </a>
            <?php
            }
            else {
            ?>
            <a class="" href="{{ url('/admin') }}">Inicio</a>
            <a class="" href="{{ url('/admins/user/index') }}">Lista de
                Usuarios</a>
            <a class="" href="{{ url('/admins/area/addArea') }}">Añadir
                Área</a>
            <a class="" href="{{ url('/addUser/create') }}">Añadir
                Usuario</a>
            <a class="" href="{{ url('/admins/area/test/create') }}">Crear
                Prueba</a>
            <a class="" href="{{ url('/admins/area/concept_test/create') }}">Agregar
                Conceptos a Pruebas</a>
            <a class="" href="{{url('/admins/maturity/editML')}}">Editar Niveles de Madurez</a>
            <a class="" href="{{url('/admins/area/test/edit')}}">Editar Test</a>
            <a class="" href="{{url('/admins/history')}}">Historial</a>
            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                {{ __('Salir') }}
            </a>
            <?php }
            ?>
        <!-- ROUTES FOR ANALISTA -->
        @elseif (Auth::user()->hasRole('analista'))
            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Salir') }}
            </a>
            <!-- ROUTES FOR COMUN -->
        @elseif(Auth::user()->hasRole('comun'))
            <a class="" href="{{ url('/comun') }}">Home</a>
            <a class="" href="{{ url('/upload') }}">Upload</a>
            <a class="" href="{{ url('/upload/show') }}">View Uploads</a>
            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Salir') }}
            </a>
        @endauth
    @endif
</div>
<div class="fixContainer mb-4">
    @yield('content')
</div>
    @yield('script')
</html>
