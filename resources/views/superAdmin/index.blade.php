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
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 20px;">
                            
                                Administradores
                        </div>
                        
                        <div class="body">
                         <div class="row clearfix">
                                <div class="col-sm-12">
                                    
                                        <h5>Aqui se mostrar los administradores registrados:</h5>
                                </div>
                                
                            </div>
                            <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Habilitado</th>
                                    <th>Compañia</th>
                                    <th>Usuario</th>
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
                                               <button type="button" id="btn-{{ $users->id }}" class="btn btn-success  waves-effect" onclick="Admin_Activa({{ $users->id }})" style="width: 100%;">
                                                    <i class="material-icons" id="mc-{{ $users->id }}">work</i> <span id="s-{{ $users->id }}">Habilitar</span> 
                                                </button>
                                                @else
                                                <button type="button" id="btn-{{ $users->id }}" class="btn btn-warning waves-effect" onclick="Admin_Activa({{ $users->id }})" style="width: 100%;">
                                                    <i class="material-icons" id="mc-{{ $users->id }}" id="s-{{ $users->id }}">lock</i> <span id="s-{{ $users->id }}">Bloquear</span> 
                                                </button>
                                                @endif
                                        </td>
                                        <td>
                                            {{$users->name }}
                                        </td>
                                        <td>
                                            {{$users->username }}
                                        </td>
                                        <td style="text-align: left;">
                                            {{ $users->firstName." ".$users->lastName }}
                                        </td>
                                        <td>
                                            {{ $users->phoneNumber }}
                                        </td>
                                        <td>
                                           {{ $users->email }}
                                        </td>
                                        
                                             <!-- button class="btn btn-primary" onclick="Admin({{ $users->id }});"> Ver </button -->
                                        
                                        <td> <a href="/superAdmin/viewcustomersuperadmin/{{ $users->id }}" class="btn btn-primary waves-effect"  style="width: 80%;">
                                            <i class="material-icons" id="mc-{{ $users->id }}">mode_edit</i> <span>Editar</span> 
                                        </a></td>
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
<script type="text/javascript">
    $("#Administradores").addClass('active');
    $("#MostrarAdmins").addClass('active');
</script>
@endsection
