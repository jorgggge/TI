@extends('layouts.app')

@section('content')


 <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 20px;">person_add</i>
                            Nuevo Administrador
                        </div>
                        <div class="body">
                            
                            <b>Llena los campos con los datos de Administrador: <br> (*) Datos Obligatorios</b> 
                            <h2 class="card-inside-title">Datos del Administrador</h2>
                            <form id="from" method="POST" action="{{ route('NewAdmin') }}"> 
                                @csrf
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Usuario</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="username" class="form-control"  placeholder="Usuario" required value="{{ old('username')}}">
                                        </div>
                                    </div>
                                     @error('username')
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                Verifique el usuario
                                            </div>
                                        @enderror
                                </div>
                                 <div class="col-sm-4">
                                    <p>
                                        <b>* Contraseña</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">vpn_key</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="password" name="password" name="emailuser" id="emailUserS"  class="form-control" placeholder="Contraseña" required>
                                        </div>
                                    </div>
                                     @error('error_pass')
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                Verifique la Contraseña
                                            </div>
                                        @enderror
                                </div>
                                 <div class="col-sm-4">
                                    <p>
                                        <b>* Confirma contraseña</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">vpn_key</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="password" name="passwordc" id="phoneNumberCS" class="form-control mobile-phone-number" placeholder="Contraseña" required>
                                        </div>
                                    </div>
                                    @error('error_pass')
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                Verifique la Contraseña
                                            </div>
                                        @enderror
                                </div>
                                
                            </div>
                            <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Nombres</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">assignment</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="firstName" id="firstNameS"  class="form-control" placeholder="Nombres" required value="{{ old('firstName')}}">
                                        </div>
                                    </div>
                                     @error('firstName')
                                        <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                            Verifique los nombres
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Apellidos</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">assignment</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="lastName" id="lastNameS"  class="form-control"  placeholder="Apellidos" required value="{{ old('lastName')}}">
                                        </div>
                                    </div>
                                     @error('lastName')
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                Verifique los apellidos
                                            </div>
                                        @enderror
                                </div>
                                 <div class="col-sm-4">
                                    <p>
                                        <b>* Email</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="email" name="email" id="lastNameS"  class="form-control"  placeholder="Email" required value="{{ old('email')}}">
                                        </div>
                                    </div>
                                     @error('email')
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                Verifique el email
                                            </div>
                                        @enderror
                                </div>
                                
                            </div>
                            <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Compañia</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">apartment</i>
                                        </span>
                                            <select type='text'required id="name" class="form-control show-tick" name="companyId">
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
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
                                 <div class="col-sm-4"></div>
                                
                            </div>
                                  
                             <div  class="row clearfix">
                                            <div class="col-sm-10"></div>
                                            <div class="col-sm-2">
                                             <center>
                                                     <button class="btn btn-primary waves-effect" id="btn-form">
                                                    <i class="material-icons">done</i> <span> Guardar </span> 
                                                </button>
                                             </center>
                                            </div>
                                        </div>
                          
                        </form>

                        </div>
                    </div>
            </div>
        </div>

<script type="text/javascript">
    $("#Administradores").addClass('active');
    $("#AgregarAdmin").addClass('active');
</script>





@if (session()->has('error_pass'))
    <script type="text/javascript">
        swal("Error", "Verifique la contraseña", "error");
    </script>
@endif

@if ($errors->any())
    <script type="text/javascript">
         swal("Error", "Verifique los datos antes de guardar", "error");
    </script>
@endif


@endsection
