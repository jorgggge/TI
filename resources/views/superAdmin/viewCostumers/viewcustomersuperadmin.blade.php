@extends('layouts.app')

@section('content')




<div id="Contenr-CreateAdmin">
    <div class="card-body" style="text-align: left;" >
         <center><h3>Actulizar datos del Administrador</h3></center>
          <h5>Llena los campos con los datos de Administrador/Empresa: <br>(*) Datos obligatorios</h5>
        @foreach ($Admin as $A)
                <form id="from" method="POST" action="{{ route('UpdateCustomer',[$A->id,$A->companyId]) }}">
                @method('PUT')
                @csrf
                   
                <br><b>* Usuario</b>
                <input type="text" name="username" id="usernameS" class="form-control" value="{{ $A->username }}">
                
           
                <br><b>* Nombre</b>
                <input type="text" name="firstName" id="firstNameS"  class="form-control"
                        value="{{ $A->firstName }}">
           
                <br><b>* Apellido</b>
                <input type="text" name="lastName" id="lastNameS"  class="form-control"
                        value="{{ $A->lastName }}">
           
                <br><b>* Email</b>
                <input type="text" name="emailuser" id="emailUserS"  class="form-control"
                        value="{{ $A->emailuser }}">
           
                <br><b>* Empresa</b>
                <input type="text" name="name" id="nameCS" class="form-control" value="{{ $A->name }}">
           
                <br><b>* Dirección</b>
                <input type="text" name="address" id="addressCS" class="form-control" value="{{ $A->address }}">
           
                <br><b>* Teléfono</b>
                <input type="text" name="phoneNumber" id="phoneNumberCS" class="form-control"
                        value="{{ $A->phoneNumber }}">
           
                <br><b>* Email</b>
                <input type="text" name="emailcompany" id="emailcompanyCS" class="form-control"
                        value="{{ $A->emailcompany }}">
            </form>
        @endforeach
    </div>
    <div style="margin: auto;">
        <h4><img src="{{ asset('imagenes/Alerta.png') }}" height="100px"><br>Nota: Podra actulizar los datos de el empresa, lo cual afecta a los demas administadores.</h4>
    </div>
</div>



@endsection
