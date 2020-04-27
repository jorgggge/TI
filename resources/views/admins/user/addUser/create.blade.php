@extends('layouts.app')
@section('content')
<div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">
                                <a href="#" style="color: white;">Usuarios</a> > Añadir nuevo Usuario
                            </h2>
                            <ul class="header-dropdown m-r--5">
                              
                            </ul>
                        </div>
                        <div class="body">
                            
                            <h5>Llena los campos con los datos del nuevo Usuario: <br> (*) Datos Obligatorios</h5> 
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
                                            <input type="text" name="username" class="form-control" placeholder="Usuario" required>
                                        </div>
                                    </div>
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
                                            <input type="password" name="password" required id="phoneNumberCS" class="form-control mobile-phone-number"  placeholder="XXXXXXX">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Comfriar Ccntraseña</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">vpn_key</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="password" name="password_confirmation" required id="firstNameS"  class="form-control" placeholder="XXXXXXX">
                                        </div>
                                    </div>
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
                                            <input type="text" name="firstName" required id="lastNameS"  class="form-control" placeholder="Nombres">
                                        </div>
                                    </div>
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
                                            <input type="text" name="lastName" id="lastNameS"  class="form-control" placeholder="Apellidos" required>
                                        </div>
                                    </div>
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
                                            <input type="text" name="email" id="lastNameS"  class="form-control" placeholder="email" required>
                                        </div>
                                    </div>
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
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-4">
                                     <button class="btn btn-info" type="submit">Guardar</button>
                                </div>
                            </div>
                                       
                            </form>

                        </div>
                    </div>
            </div>
</div>

<script type="text/javascript">
    $("#Usuarios").addClass('active');
    $("#AgregarUsuario").addClass('active');

</script>


@endsection