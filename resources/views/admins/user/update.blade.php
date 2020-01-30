@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SuperAdmin</title>
    <link rel="stylesheet" href="">
</head>
<main class='viewCustomer container'>

    <div class="Customer">

        <!--Desaparece-->
        <div class="Personal">
            <div class="">
                <center>
                    <p style="font-size: 20px; color: #25A1F9;">{{ $User['firstName']." ".$User['lastName']}}</p>
                </center>
            </div>
            <div>
                <p class="DatoPersonal"> Datos Personales</p>
            </div>
            <!--TABLES-->
            <form id="from" method="POST" action="{{ route('UpdateUsers',[$User['id']]) }}">
                @method('PUT')
                @csrf
                <table class="Table_Customer" id="tAdmin">
                    <!--TABLA ADMIN-->
                    <tr>
                        <th>Usuario</th>
                        <td><input type="text" name="username" id="usernameU" class="form-control" readonly
                                value="{{ $User['username'] }}"></td>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <td><input type="text" name="firstName" id="firstNameU" class="form-control" readonly
                                value="{{ $User['firstName'] }}"></td>
                    </tr>
                    <tr>
                        <th>Apellido</th>
                        <td><input type="text" name="lastName" id="lastNameU" class="form-control" readonly
                                value="{{ $User['lastName'] }}"></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input type="text" name="emailuser" id="emailuserU" class="form-control" readonly
                                value="{{ $User['email'] }}"></td>
                    </tr>
                    <tr>
                        <th>Áreas</th>
                        <td>
                            <div id="areauser">
                                @foreach ($User_Area as $UA)
                                {{ $UA->name }} <br>
                                @endforeach

                            </div>

                            <div id="check" style="display:none;" class="custom-control custom-checkbox">
                              @php($count=0)
                                @foreach ($Array_Areas as $UA)

                                @if ($UA['validar'])
                                <input class="form-check-input" type="checkbox" name="checked{{ $UA['areaId']}}"
                                    value="{{ $UA['areaId']}}" id="defaultCheck{{ $UA['areaId']}}" checked="true">
                                @else
                                <input class="form-check-input" type="checkbox" name="checked{{ $UA['areaId']}}"
                                    value="{{ $UA['areaId']}}" id="defaultCheck{{ $UA['areaId']}}">
                                @endif
                                <label class="form-check-label" for="defaultCheck{{ $UA['areaId']}}">
                                    {{ $UA['name']}}
                                </label>
                                <br>
                                @endforeach
                            </div>

                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="buttContainer">
            <div class='bttns'>
                <input type="button" value="Editar" class="btn Button_Edit bttn" id="editar"
                    style="background-color: #25A1F9" onclick="ShowButtonAdmin()">
                <input type="button" class="btn Button_Edit bttn" id="eliminar" value="Eliminar"
                    style="background-color: #d9534f; width: 70px;display:block;"
                    onclick="$('#NoteDelete').modal();">
                <input type="submit" value="Guardar" class="btn Button_Edit bttn" id="guardar"
                    style="display: none;background-color: #5cb85c" onclick="$('#myModal').modal();">
                <input type="button" value="Cancelar" class="btn Button_Edit bttn" id="cancelar"
                    style="display:none;background-color: #d9534f;" onclick="EditAdminUser(false)">
            </div>
        </div>

    </div>

</main>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="myModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color: green;color: white;" >
      <div class="modal-header " >
        <h5 class="modal-title"  id="exampleModalLongTitle">Actulizar cambios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div style="background-color: white;color: black;">
           <center>
             <div class="modal-body" >
                ¿Desea actulizar los datos del usuario?
              </div>
              <div class="update" style="display: none;"><br><h1>Actulizando datos ...</h1></div>
              <div class="spinner-border m-5" role="status" style="display: none;">          
                  <span class="sr-only">Loading...</span>
              </div>
        </center>
      </div>
       
      <div class="modal-footer" style="background-color: white;color: black;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="EditAdminUser(true)">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="NoteDelete">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"style="background-color: #D9534F;color: white;">
      <div class="modal-header ">
        <h5 class="modal-title"  id="exampleModalLongTitle">Elminacion de Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div style="background-color: white;color: black;">
           <center>
                 <div class="modal-body">
                    ¿Desea eliminar a este usuario?
                  </div>
                  <div class="update" style="display: none;"><br><h1>Actulizando datos ...</h1></div>
                  <div class="spinner-border m-5" role="status" style="display: none;">          
                      <span class="sr-only">Loading...</span>
                  </div>
            </center>
       </div>
      <div class="modal-footer" style="background-color: white;color: black;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="window.location='{{ route('DeleteUsers',$User['id']) }}'">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="errorDataUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #D9534F;color: white;">
        <h5 class="modal-title" id="exampleModalLongTitle">¡ERROR!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Necesita llenar todos los campos de forma adecuada.
        <br><br><b>NOTA:</b> No puede guardar un usuario sin minímo un área.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection