<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php
use App\User;
use App\MaturityLevel;
use Illuminate\Support\Facades\Auth;
?>

<head>
    @yield('head')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ICA') }}</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('plugins/node-waves/waves.css') }}" rel="stylesheet" />

     <!-- Dropzone Css -->
    <link href="{{ asset('plugins/dropzone/dropzone.css') }}" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="{{ asset('plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="{{ asset('plugins/jquery-spinner/css/bootstrap-spinner.css') }}" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <!-- noUISlider Css -->
    <link href="{{ asset('plugins/nouislider/nouislider.min.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{ asset('plugins/morrisjs/morris.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('css/themes/all-themes.css') }}" rel="stylesheet" />

     <!-- JQuery DataTable Css -->
    <link href="{{ asset('../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
  
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


</head>
<body> 

   <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Espero por favor ...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
  
@if(Auth::user()->hasRole('superadmin'))

<nav class="navbar" style="background-color: #112d4e;">
    <div class="container-fluid">
          <div class="navbar-header">
              <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
              <a href="javascript:void(0);" class="bars"></a>
              <a class="navbar-brand" href="index.html" style="color: white;">SUPER ADMIN</a>
          </div>
      </div>
</nav>
<section>
  <!-- Left Sidebar -->
  <aside id="leftsidebar" class="sidebar">
      <!-- User Info -->
      <div class="user-info">
          <div class="image">
              <img src="{{ asset('images/user.png') }}" width="48" height="48" alt="User" />
          </div>
          <div class="info-container">
              <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @php
                  echo Auth::user()->firstName." ".Auth::user()->lastName;
                @endphp
              </div>
              <div class="email">Super Administrator</div>
          </div>
      </div>
      <!-- #User Info -->
      <!-- Menu -->
      <div class="menu">
          <ul class="list">
              <li class="header">MENU</li>
              <li id="Company">
                  <a href="#" class="menu-toggle">
                      <i class="material-icons">apartment</i>
                      <span>Compañias</span>
                  </a>
                  <ul class="ml-menu">
                      <li id="CompanySee">
                          <a href="{{ url('/superAdmin/company' ) }}">
                            <i class="material-icons">domain</i>
                              <span>Mostrar compañias</span>
                          </a>
                      </li>
                      <li id="CompanyAdd">
                          <a href="{{url('CreateCompany/addCompany/create')}}">
                            <i class="material-icons">group_add</i>
                              <span>Agregar compañia</span>
                          </a>                            
                        </li>
                  </ul>
              </li>
              <li id="Administradores">
                  <a href="#"  class="menu-toggle">
                      <i class="material-icons">supervisor_account</i>
                      <span>Administradores</span>
                  </a>
                  <ul class="ml-menu">
                      <li id="MostrarAdmins">
                          <a href="{{ url('/superAdmin/admins' ) }}">
                            <i class="material-icons">supervised_user_circle</i>
                              <span>Mostrar Admins</span>
                          </a>
                      </li>
                      <li id="AgregarAdmin">
                          <a href="{{url('CreateAdmin/addAdmin/create')}}">
                            <i class="material-icons">person_add</i>
                              <span>Agregar Admins</span>
                          </a>                            
                        </li>
                  </ul>
              </li>
              <li id="Historial">
                  <a href="{{ url('/superAdmin/history' ) }}">
                      <i class="material-icons">history</i>
                      <span>Hitorial</span>
                  </a>
              </li>
              <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="material-icons">input</i>
                      <span>Salir</span>
                  </a>
              </li>
          </ul>
      </div>
      <!-- #Menu -->
      <!-- Footer -->
      <div class="legal">
          <div class="copyright">
              &copy; 2020 <a href="javascript:void(0);">ICA</a>.
          </div>
          <div class="version">
              <b>Version: </b> 2.0.5
          </div>
      </div>
      <!-- #Footer -->
  </aside>
  <!-- #END# Left Sidebar -->

</section> 
<form id="logout-form" action="{{ route('logout') }}" method="POST"
          style="display: none;">
        @csrf
    </form>

<section class="content">
  @yield("content")
</section>



@endif
    

@if(Auth::user()->hasRole('admin'))

<nav class="navbar" style="background-color: #112d4e;">
    <div class="container-fluid">
          <div class="navbar-header">
              <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
              <a href="javascript:void(0);" class="bars"></a>
              <a class="navbar-brand" href="index.html" style="color: white;">ADMINTRADOR</a>
          </div>
      </div>
</nav>
<section>
  <!-- Left Sidebar -->
  <aside id="leftsidebar" class="sidebar">
      <!-- User Info -->
      <div class="user-info">
          <div class="image">
              <img src="{{ asset('images/user.png') }}" width="48" height="48" alt="User" />
          </div>
          <div class="info-container">
              <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @php
                  echo Auth::user()->firstName." ".Auth::user()->lastName;
                @endphp
              </div>
              <div class="email">Administrator</div>
          </div>
      </div>
      <!-- #User Info -->
      <!-- Menu -->
      <div class="menu">

        @php
          $user = auth()->user();
          $userId = $user->companyId;
          $admins = User::all();
          $CountMaturity = MaturityLevel::where('companyId', '=', $userId)->count();
        @endphp
        @if ($CountMaturity == 0)
              <ul class="list">
                <li class="header">MENU</li>
              </ul>
        @else
            <ul class="list">
                <li class="header">MENU</li>
                <li id="Area" >
                    <a href="#"  class="menu-toggle">
                        <i class="material-icons">nature_people</i>
                        <span>Areas</span>
                    </a>
                    <ul class="ml-menu">
                        <li id="MostrarAreas">
                            <a href="{{ url('/admin') }}">
                              <i class="material-icons">nature</i>
                                <span>Mostrar Areas</span>
                            </a>
                        </li>
                        <li id="Agregar Area">
                            <a href="#" onclick="CreaArea()">
                              <i class="material-icons">nature_people</i>
                                <span>Agregar Area</span>
                            </a>                            
                          </li>
                    </ul>
                </li> 
                <li id="Usuarios">
                    <a href="#" class="menu-toggle">
                        <i class="material-icons">supervisor_account</i>
                        <span>Usuarios</span>
                    </a>
                    <ul class="ml-menu">
                        <li id="MostrarUsuarios">
                            <a href="{{ url('/admins/user' ) }}">
                              <i class="material-icons">supervisor_account</i>
                                <span>Mostrar Usuarios</span>
                            </a>
                        </li>
                        <li id="AgregarUsuario">
                            <a href="{{url('/admins/createUser')}}">
                              <i class="material-icons">group_add</i>
                                <span>Agregar Usuario</span>
                            </a>                            
                          </li>
                    </ul>
                </li>
                <li id="Pruebas">
                    <a href="#" class="menu-toggle">
                        <i class="material-icons">assignment</i>
                        <span>Pruebas</span>
                    </a>
                    <ul class="ml-menu">
                        <li id="MostrarPruebas">
                            <a href="{{ url('/admin/pruebas') }}">
                              <i class="material-icons">assignment_turned_in</i>
                                <span>Mostrar Pruebas</span>
                            </a>
                        </li>
                        <li id="AgregarPrueba">
                            <a href="{{url('/admins/area/test/create')}}">
                              <i class="material-icons">assignment</i>
                                <span>Crear Prueba</span>
                            </a>                            
                          </li>
                    </ul>
                </li>
                <li id="NivelesdeMadurez">
                    <a href="{{ url('/admins/maturity/editML' ) }}">
                        <i class="material-icons">insert_chart</i>
                        <span>Niveles de Madurez</span>
                    </a>
                </li>
                <li id="Historial">
                    <a href="{{ url('/admins/history' ) }}">
                        <i class="material-icons">history</i>
                        <span>Hitorial</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>Salir</span>
                    </a>
                </li>
            </ul>
          @endif
      </div>
      <!-- #Menu -->
      <!-- Footer -->
      <div class="legal">
          <div class="copyright">
              &copy; 2020 <a href="javascript:void(0);">ICA</a>.
          </div>
          <div class="version">
              <b>Version: </b> 2.0.5
          </div>
      </div>
      <!-- #Footer -->
  </aside>
  <!-- #END# Left Sidebar -->

</section> 
<form id="logout-form" action="{{ route('logout') }}" method="POST"
          style="display: none;">
        @csrf
    </form>

<section class="content">
  @yield("content")
</section>



@endif

@if(Auth::user()->hasRole('analista'))

<nav class="navbar" style="background-color: #112d4e;">
    <div class="container-fluid">
          <div class="navbar-header">
              <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
              <a href="javascript:void(0);" class="bars"></a>
              <a class="navbar-brand" href="index.html" style="color: white;">ANALISTA</a>
          </div>
      </div>
</nav>
<section>
  <!-- Left Sidebar -->
  <aside id="leftsidebar" class="sidebar">
      <!-- User Info -->
      <div class="user-info">
          <div class="image">
              <img src="{{ asset('images/user.png') }}" width="48" height="48" alt="User" />
          </div>
          <div class="info-container">
              <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @php
                  echo Auth::user()->firstName." ".Auth::user()->lastName;
                @endphp
              </div>
              <div class="email">Analista</div>
          </div>
      </div>
      <!-- #User Info -->
      <!-- Menu -->
      <div class="menu">
          <ul class="list">
              <li class="header">MENU</li>
              <li>
                  <a href="/analista">
                      <i class="material-icons">home</i>
                      <span>Inicio</span>
                  </a>
              </li>
               <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="material-icons">input</i>
                      <span>Salir</span>
                  </a>
              </li>
          </ul>

      </div>
      <!-- #Menu -->
      <!-- Footer -->
      <div class="legal">
          <div class="copyright">
              &copy; 2020 <a href="javascript:void(0);">ICA</a>.
          </div>
          <div class="version">
              <b>Version: </b> 2.0.5
          </div>
      </div>
      <!-- #Footer -->
  </aside>
  <!-- #END# Left Sidebar -->

</section> 
<form id="logout-form" action="{{ route('logout') }}" method="POST"
          style="display: none;">
        @csrf
    </form>

<section class="content">
  @yield("content")
</section>



@endif

@if(Auth::user()->hasRole('comun'))

<nav class="navbar" style="background-color: #112d4e;">
    <div class="container-fluid">
          <div class="navbar-header">
              <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
              <a href="javascript:void(0);" class="bars"></a>
              <a class="navbar-brand" href="index.html" style="color: white;">BIENVENIDO</a>
          </div>
      </div>
</nav>
<section>
  <!-- Left Sidebar -->
  <aside id="leftsidebar" class="sidebar">
      <!-- User Info -->
      <div class="user-info">
          <div class="image">
              <img src="{{ asset('images/user.png') }}" width="48" height="48" alt="User" />
          </div>
          <div class="info-container">
              <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @php
                  echo Auth::user()->firstName." ".Auth::user()->lastName;
                @endphp
              </div>
              <div class="email">Usuario Comun</div>
          </div>
      </div>
      <!-- #User Info -->
      <!-- Menu -->
      <div class="menu">
          <ul class="list">
              <li class="header">MENU</li>
              <li>
                  <a href="/comun">
                      <i class="material-icons">home</i>
                      <span>Inicio</span>
                  </a>
              </li>
              <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="material-icons">input</i>
                      <span>Salir</span>
                  </a>
              </li>
          </ul>
      </div>
      <!-- #Menu -->
      <!-- Footer -->
      <div class="legal">
          <div class="copyright">
              &copy; 2020 <a href="javascript:void(0);">ICA</a>.
          </div>
          <div class="version">
              <b>Version: </b> 2.0.5
          </div>
      </div>
      <!-- #Footer -->
  </aside>
  <!-- #END# Left Sidebar -->

</section> 
<form id="logout-form" action="{{ route('logout') }}" method="POST"
          style="display: none;">
        @csrf
    </form>

<section class="content">
  @yield("content")
</section>



@endif

    <!-- Jquery Core Js -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('plugins/node-waves/waves.js') }}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('plugins/morrisjs/morris.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{ asset('plugins/flot-charts/jquery.flot.js') }}"></script>
    <script src="{{ asset('plugins/flot-charts/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('plugins/flot-charts/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('plugins/flot-charts/jquery.flot.time.js') }}"></script>

  <!-- Bootstrap Tags Input Plugin Js -->
    <script src="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>

    <!-- Input Mask Plugin Js -->
    <script src="{{ asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>


    <!-- noUISlider Plugin Js -->
    <script src="{{ asset('plugins/nouislider/nouislider.js') }}"></script>


    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

    <!-- Chart Plugins Js -->
    <script src="{{ asset('plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Dropzone Plugin Js -->
    <script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/pages/index.js') }}"></script>
    <script src="{{ asset('js/pages/charts/chartjs.js') }}"></script>

    <!-- Demo Js -->
    <script src="{{ asset('js/demo.js') }}"></script>

    <!-- Propios Js-->
    <script src="{{ asset('js/customer.js') }}"></script>

    <script type="text/javascript">
      function  CreaArea() {
        swal("Nombre del area nueva:", {
            content: "input",
          })
          .then((value) => {
                  $.ajax({
                      type: "GET",
                      url: "/AddArea/"+value,
                      success: function(response){}
                });
                
            });
      }
    </script>
</body>
</html>
