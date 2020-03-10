@extends('layouts.app')

@section('content')


<div id="Contenr-CreateAdmin">

    <div style="text-align: left;">
        <div class="card-body" >
            <center><h3>Agregar Administrador</h3></center>
            <h5>Llena los campos con los datos de Administrador: <br>(*) Datos obligatorios</h5>
        <form id="Form_Admin" method="POST" action="/CreateAdmin/superAdmin">
        @csrf
         
        <br><b>* Usuario:</b>
        <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <br><b>* Contraseña:</b>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <br><b>* Confirma Contraseña:</b>            
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

        @error('password-confirmation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
                  
        <br><b>* Correo electronico:</b>  
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
                    
        
        <br><b>* Nombre:</b>        
        <input id="name" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>

        @error('firstName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <br><b>* Apellido</b>
         <input id="name" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>

        @error('lastName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        
        <br><b>* Empresa Asignada</b>
                    
        <select type='text'required id="name"
            class="custom-select @error('name') is-invalid @enderror"
            name="companyId">
            <option disabled selected>Selecciona la empresa...</option>
            @php($count=0)

            @foreach($companies as $company)
            @if ($company->companyId !=1)
            <option value="{{ $company->companyId }}">{{ $company->name }}</option>
            @endif
            @php($count++)
            @endforeach

            @if($count ==1)
            <option disabled selected>No hay empresas</option>
            @endif
        </select>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

            <div>
                    <br>
                    <button type="submit" class="btn btn-primary" style="margin-left: 45%;">Agregar</button>
            </div>
        </form>
        @include('errors')
    </div>
    </div>
    <div style="margin: auto;">
        <center><h4><img src="{{ asset('imagenes/Alerta.png') }}" height="100px"><br>Nota: Verifica si el usuario a registrar, existan su empresa.</h4></center>
    </div>
</div>
@endsection
