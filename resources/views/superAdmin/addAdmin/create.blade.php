@extends('layouts.app')

@section('content')


 <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">
                                <a href="#" style="color: white;">Administradores</a> > Añadir nuevo administrador
                            </h2>
                            <ul class="header-dropdown m-r--5">
                              
                            </ul>
                        </div>
                        <div class="body">
                            
                            <h5>Llena los campos con los datos de Administrador:</h5> 
                            <h2 class="card-inside-title">Datos del Administrador</h2>
                            <form id="from" method="POST" action="/CreateAdmin/superAdmin"> 
                                @method('PUT')
                                @csrf
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <p>
                                        <b>Usuario</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="username" class="form-control"  placeholder="Usuario" required>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <p>
                                        <b>Contraseña</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">vpn_key</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="username" name="emailuser" id="emailUserS"  class="form-control" placeholder="Contraseña" required>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <p>
                                        <b>Confirma contraseña</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">vpn_key</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="phoneNumber" id="phoneNumberCS" class="form-control mobile-phone-number" placeholder="Contraseña" required>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                <div class="col-sm-4">
                                    <p>
                                        <b>Nombres</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">assignment</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="firstName" id="firstNameS"  class="form-control" placeholder="Nombres" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        <b>Apellidos</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">assignment</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="lastName" id="lastNameS"  class="form-control"  placeholder="Apellidos" required>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <p>
                                        <b>Email</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="lastName" id="lastNameS"  class="form-control"  placeholder="Email" required>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                <div class="col-sm-4">
                                    <p>
                                        <b>Nombres</b>
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
                                  
                            <div>
                                <button class="btn btn-info">Guardar</button>
                            </div>
                          
                        </form>

                        </div>
                    </div>
            </div>
        </div>


@endsection
