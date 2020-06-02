@extends('layouts.app')


@section('content')

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 20px;">supervised_user_circle</i>
                            Administradores
                        </div>
                        <div class="body">
                            <b>Aquí se mostrar los administradores registrados:</b><br><br>
                            <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Nombre</th>
                                    <th>Estatus</th>
                                    <th>Usuario</th>
                                    <th>Compañía</th>
                                    <th>Tel. Compañía</th>
                                    {{-- <th>Correo</th> --}}
                                    <th>Editar</th>
                                  </tr>
                                </thead>
                                <tbody id="myTable">
                                @foreach($Admins as $users)
                                    <tr>
                                        <td style="text-align: left;">
                                            {{ $users->firstName." ".$users->lastName }}
                                        </td>
                                        <td>
                                             @if ($users->S != 1)
                                               <button type="button" id="btn-{{ $users->id }}" class="btn btn-success  waves-effect" onclick="Admin_Activa({{ $users->id }})" >
                                                    <i class="material-icons" id="mc-{{ $users->id }}">work</i> <span id="s-{{ $users->id }}">Habilitar</span> 
                                                </button>
                                                @else
                                                <button type="button" id="btn-{{ $users->id }}" class="btn btn-warning waves-effect" onclick="Admin_Activa({{ $users->id }})" >
                                                    <i class="material-icons" id="mc-{{ $users->id }}" id="s-{{ $users->id }}">lock</i> <span id="s-{{ $users->id }}">Bloquear</span> 
                                                </button>
                                                @endif
                                        </td>
                                        <td>
                                            {{$users->username }}
                                        </td>
                                        <td>
                                            {{$users->name }}
                                        </td>
                                        <td>
                                            {{ $users->phoneNumber }}
                                        </td>
                                        
                                        <td> <a href="{{ route('ViewCustomer',[$users->id]) }}" class="btn btn-primary waves-effect">
                                            <i class="material-icons" id="mc-{{ $users->id }}">mode_edit</i> 
                                        </a></td>
                                    </tr>
                                    
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    </div>
            <!-- #END# Basic Examples -->
        </div>
<script src="{{ asset('js/code.js') }}"></script>

@if (session()->has('successAddAdmin'))
    <script type="text/javascript">
    swal("Listo!", "Se ha ingresado una nuevo administrador!", "success");
    </script>
@endif

<script type="text/javascript">
    $("#Administradores").addClass('active');
    $("#MostrarAdmins").addClass('active');
</script>
@endsection
