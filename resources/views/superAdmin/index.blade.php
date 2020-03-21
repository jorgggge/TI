@extends('layouts.app')


@section('content')

        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    <!-- Administradores -->
                    <small></small>
                </h2>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            
                            <h2 style="color: white;">
                                Administradores
                            </h2>
                            <ul class="header-dropdown m-r-0">
                                <li>
                                    <a href="javascript:void(0);">
                                        <i class="material-icons">info_outline</i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <i class="material-icons">help_outline</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="body">
                         <div class="row clearfix">
                                <div class="col-sm-4">
                                    
                                        <button type="button" class="btn btn-lg btn-primary waves-effect">
                                            <i class="material-icons">person_add</i>
                                            <span>Agregar Administrador</span>
                                        </button>

                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                         <span class="input-group-addon">
                                            <i class="material-icons">search</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" id="myInput" class="form-control" placeholder="Buscar Administradores" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Habilitado</th>
                                    <th>Compañia</th>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th>Actulizacion</th>
                                  </tr>
                                </thead>
                                <tbody id="myTable">
                                @foreach($Admins as $users)
                                    <tr>
                                        <td>
                                             @if ($users->S == 1)
                                               <button type="button" class="btn btn-success btn-circle-lg waves-effect waves-circle waves-float" onclick="Admin_Activa({{ $users->id }},'{{ csrf_token() }}')">
                                                    <i class="material-icons">work</i>
                                                </button>
                                                @else
                                                <button type="button" class="btn btn-warning btn-circle-lg waves-effect waves-circle waves-float" onclick="Admin_Activa({{ $users->id }},'{{ csrf_token() }}')">
                                                    <i class="material-icons">work_off</i>
                                                </button>
                                                @endif
                                        </td>
                                        <td>
                                            {{$users->name }}
                                        </td>
                                        <td>
                                            {{ $users->firstName." ".$users->lastName }}
                                        </td>
                                        <td>
                                            {{ $users->phoneNumber }}
                                        </td>
                                        <td>
                                           {{ $users->email }}
                                        </td>
                                        
                                             <!-- button class="btn btn-primary" onclick="Admin({{ $users->id }});"> Ver </button -->
                                        
                                        <td> <a href="/superAdmin/viewcustomersuperadmin/{{ $users->id }}" class="btn btn-primary btn-circle-lg waves-effect waves-circle waves-float"><i class="material-icons" style="margin: auto;">create</i></a></td>
                                    </tr>
                                    
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
<script src="{{ asset('js/code.js') }}"></script>

</script>
@endsection
