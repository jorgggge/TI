@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 20px;">group_add</i>
                            Nuevo Usuario
                        </div>
                        <div class="body">
                            
                             <b> Llena los campos con los datos del nuevo Usuario: <br>
                           (*) Datos Obligatorios <br> El usuario no se podrar cambiar despues</b>
                            <h2 class="card-inside-title">Datos del Usuario:</h2>
                            <form method="POST" action="{{ url('/admins/user_new') }}" > 
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
                                            <input type="text" name="username" class="form-control" placeholder="Usuario" value="{{ old('username') }}" required>
                                        </div>
                                    </div>
                                    @error('username')
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                Usuario ya ultilizado. 
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
                                            <input type="password" name="password" required id="phoneNumberCS" class="form-control mobile-phone-number"  placeholder="XXXXXXX" value="{{ old('password') }}">
                                        </div>
                                    </div>
                                    @error('password')
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                Verifique el email del contraseña
                                            </div>
                                        @enderror
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Confirmar Contraseña</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">vpn_key</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="password" name="password_confirmation" required id="firstNameS"  class="form-control" placeholder="XXXXXXX" value="{{ old('password_confirmation') }}">
                                        </div>
                                    </div>
                                    @error('password_confirmation')
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                Verifique la contraseña
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
                                            <input type="text" name="firstName" required id="lastNameS"  class="form-control" placeholder="Nombres" value="{{ old('firstName') }}">
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
                                            <input type="text" name="lastName" id="lastNameS"  class="form-control" placeholder="Apellidos" value="{{ old('lastName') }}" required>
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
                                            <input type="text" name="email" id="lastNameS"  class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                     @error('email')
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                Verifique el email del usuario
                                            </div>
                                        @enderror
                                </div>
                                
                            </div>
                            <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Rol</b>
                                    </p>
                                    <select name="role" class="form-control show-tick">
                                        <option value="3">Analista</option>
                                        <option value="4">Comun</option>
                                    </select>

                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Areas</b>
                                    </p>
                                        @php
                                            $contador = 1;
                                        @endphp
                                        @foreach ($areas as $area)
                                        @if ($area['companyId'] = $userCompany)
                                            <input class="lever" type="checkbox" id="check{{ $contador }}" 
                                                name="areas[{{$area['name']}}]" value="{{ $area['areaId'] }}">
                                            <label for="check{{ $contador }}">
                                                {{ $area['name'] }}
                                            </label>
                                        @endif
                                        @php
                                            $contador++;
                                        @endphp
                                        @endforeach
                                </div>
                            </div>
                            <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                <div class="col-sm-8">
                                </div>
                                <div class="col-sm-4">
                                    <center>
                                         <button class="btn btn-primary waves-effect" type="submit">
                                        <i class="material-icons" >mode_edit</i> <span>Guardar</span> 
                                    </button>
                                    </center>
                                </div>
                            </div>
                                       
                            </form>

                        </div>
                    </div>
            </div>
</div>



@if ($errors->any())
    <script type="text/javascript">
         swal("Error", "Verifique los datos antes de guardar", "error");
    </script>
@endif

<script type="text/javascript">
    $("#Usuarios").addClass('active');
    $("#AgregarUsuario").addClass('active');

</script>


@endsection