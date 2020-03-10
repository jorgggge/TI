@extends('layouts.app')


@section('content')

        <div id="Panel" style="background-color: white;">

            <div id="Cabezara" class="Item">
               
                <div style="width: 100%;background-color: white;">
                            <br>
                    <div style="width: 98%;margin: auto;display: grid;grid-template-columns: 20% 68% 10%;grid-gap: 10px;">
                            <div>
                                <table class="table" style="background-color: #E0F3F3;" >
                                    <thead style="background-color: #112d4e;color: white;">
                                        <tr>
                                            <td>
                                                Se encuenta en: 
                                            </td>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td>
                                            <center>
                                                <img src="{{ asset('imagenes/admistrador.png') }}" height="100px">
                                            <h4>Administradores</h4>
                                            </center>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <table class="table" style="background-color: #E0F3F3;" >
                                    <thead style="background-color: #112d4e;color: white;">
                                        <tr>
                                            <td>
                                                Busquedad
                                            </td>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td><br>
                                            <p>Se mostrar los administadores de cada emprsa registrada.Podra buscar los administadores por su compania o nombre:</p>
                                            <input class="form-control" id="anythingSearch" type="text" placeholder="Busquedad por Compañia o Administrador" style="width: 100%;">
                                        </td>
                                    </tr>
                                </table>
                                
                            </div>
                            <div> 
                                <table class="table" style="background-color: #E0F3F3;" >
                                    <thead style="background-color: #112d4e;color: white;">
                                        <tr>
                                            <td>
                                                Herramientas
                                            </td>
                                        </tr>
                                    </thead>
                                    <tr>
                                        <td>
                                            <button class="btn btn-danger"> Agregar </button>
                                            <button class="btn btn-danger"> Editar </button>
                                            <button class="btn btn-danger"> Eliminar </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                    </div>
                    
                    <div id="area_admins">
                        <div id="area" style="width: 100%;text-align: center;">                   
                            <table class="table table-hover" style="background-color: #E0F3F3;">
                                <thead style="background-color: #112d4e;color: white;">
                                  <tr>
                                    <td>Habilitado</td>
                                    <td>Compañia</td>
                                    <td>Nombre</td>
                                    <td class="Datos">Telefono</td>
                                    <td class="Datos">Correo</td>
                                    <td id="Datos_P">Datos personales</td>
                                    <td>Actulizacion</td>
                                  </tr>
                                </thead>
                                <tbody id="Mytable">
                                @foreach($Admins as $users)
                                    <tr>
                                        <td>
                                             @if ($users->S == 1)
                                               <img id="A{{ $users->id }}" class="Si" src="{{ asset('imagenes/Si.png') }}" onclick="Admin_Activa({{ $users->id }},'{{ csrf_token() }}')" height="50px">
                                                @else
                                                <img id="A{{ $users->id }}" class="No" src="{{ asset('imagenes/No.png') }}" onclick="Admin_Activa({{ $users->id }},'{{ csrf_token() }}')" height="50px">
                                                @endif
                                        </td>
                                        <td>
                                            {{$users->name }}
                                        </td>
                                        <td style="margin: auto;">
                                            {{ $users->firstName." ".$users->lastName }}
                                        </td>
                                        <td class="Datos">
                                            {{ $users->phoneNumber }}
                                        </td>
                                        <td class="Datos">
                                           {{ $users->email }}
                                        </td>
                                        <td id="Ver_Datos">
                                             <button class="btn btn-primary" onclick="Admin({{ $users->id }});"> Ver </button>
                                        </td>
                                        <td> <a href="/superAdmin/viewcustomersuperadmin/{{ $users->id }}" class="btn btn-primary"> Editar</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>    
                    </div>
                </div>
            </div>
            
        </div>
@endsection
