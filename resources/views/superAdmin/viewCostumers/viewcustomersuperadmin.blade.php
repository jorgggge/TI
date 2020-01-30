@extends('layouts.app')

@section('content')



<main class='viewCustomer container'>
    @foreach ($Admin as $A)

    <div class="Customer">
        <div class="">
            <center>
                <p style="font-size: 25px">{{ $A->name }}</p>
                <p style="font-size: 20px; color: #25A1F9;">{{ $A->firstName." ".$A->lastName}}</p>

                @if ( session('mensaje') )
                <div class="alert alert-success" class='message' id='message'>{{ session('mensaje') }}</div>
                @endif
                @can('update')

                <form method="POST" action="{{ route('DeleteCustomer',$A->companyId) }}">
                    @method('PUT')
                    @csrf
                    @if ($A->status == 1)
                    <input type="text" name="status" style="width: 0px;border:none; " readonly value="0">
                    <input type="submit" value="Deshabilitar" class="btn"
                        style="background-color: red;color:white;">@endif
                    @if ($A->status != 1)
                    <input type="text" name="status" style="width: 0px;border:none; " readonly value="1">
                    <input type="submit" value="Habilitar" class="btn" style="background-color: #5cb85c;color:white;">
                    @endif
                </form>
                @endcan
            </center>
        </div>
        <!--Desaparece-->
        <div class="Personal">
            <div class="btn-group" role="group">
                <input type="button" class="btn Customerbtn " id="Customerbtn" value="Datos Personales"
                    style="background-color: transparent; border-bottom-color: #25A1F9" onclick="ChangeAdmin()">
                <input type="button" class="btn Customerbtn" id="Customerbtn2" value="Datos de la Empresa"
                    style="background-color: transparent;" onclick="ChangeCompany()">
            </div>
            <!--TABLES-->

            <form id="from" method="POST" action="{{ route('UpdateCustomer',[$A->id,$A->companyId]) }}">
                @method('PUT')
                @csrf
                <table class="Table_Customer" id="tAdmin">
                    <!--TABLA ADMIN-->
                    <tr>
                        <th>Usuario</th>
                        <td><input type="text" name="username" id="usernameS" class="form-control" readonly value="{{ $A->username }}">
                        </td>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <td><input type="text" name="firstName" id="firstNameS"  class="form-control" readonly
                                value="{{ $A->firstName }}"></label></td>
                    </tr>
                    <tr>
                        <th>Apellido</th>
                        <td><input type="text" name="lastName" id="lastNameS"  class="form-control" readonly
                                value="{{ $A->lastName }}"></label></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input type="text" name="emailuser" id="emailUserS"  class="form-control" readonly
                                value="{{ $A->emailuser }}"></label></td>
                    </tr>
                </table>

                <table class="Table_Customer" id="tCompany" style="display: none;">
                    <!--TABLA EMPRESA-->
                    <tr>
                        <th>Empresa</th>
                        <td><input type="text" name="name" id="nameCS" class="form-control" readonly value="{{ $A->name }}"></td>
                    </tr>
                    <tr>
                        <th>Dirección</th>
                        <td><input type="text" name="address" id="addressCS" class="form-control" readonly value="{{ $A->address }}">
                        </td>
                    </tr>
                    <tr>
                        <th>Teléfono</th>
                        <td><input type="text" name="phoneNumber" id="phoneNumberCS" class="form-control" readonly
                                value="{{ $A->phoneNumber }}"></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input type="text" name="emailcompany" id="emailcompanyCS" class="form-control" readonly
                                value="{{ $A->emailcompany }}"></td>
                    </tr>
                </table>
            </form>
        </div>
        @can('update')

        <div id="buttContainer">
            <div class='bttns'>
                <input type="button" value="Editar" class="btn Button_Edit bttn" id="editar"
                    style="background-color: #25A1F9" onclick="ShowButton()">
                <input type="submit" value="Guardar" class="btn Button_Edit bttn" id="guardar"
                    style="display: none;background-color: #5cb85c" onclick="$('#ModalUserEdit').modal()">
                <input type="button" value="Cancelar" class="btn Button Edit bttn" id="cancelar"
                    style="display:none;background-color: #d9534f;" onclick="Edit(false)">
            </div>
        </div>
        @endcan
    </div>
    @endforeach
</main>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="ModalUserEdit">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color: green;color: white;" >
      <div class="modal-header " >
        <h5 class="modal-title"  id="exampleModalLongTitle">Actualizar Datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div style="background-color: white;color: black;">
           <center>
             <div class="modal-body" >
                ¿Desea actualizar los datos?
              </div>
              <div class="update" style="display: none;"><br><h1>Actualizando datos ...</h1></div>
              <div class="spinner-border m-5" role="status" style="display: none;">
                  <span class="sr-only">Loading...</span>
              </div>
        </center>
      </div>

      <div class="modal-footer" style="background-color: white;color: black;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="Edit(true)">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="errorDataAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@endsection
