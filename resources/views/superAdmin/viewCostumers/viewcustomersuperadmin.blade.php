@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">
                                <a href="#" style="color: white;">Administradores</a> > Actualizacion
                            </h2>
                            <ul class="header-dropdown m-r--5">
                              
                            </ul>
                        </div>
                        <div class="body">
                            
                            <h5>Llena los campos con los datos de Administrador: <br> (*) Datos Obligatorios</h5> 
                            <h2 class="card-inside-title">Datos del Administrador</h2>
                            @foreach ($Admin as $A)
                            <form id="from" method="POST" action="{{ route('UpdateCustomer',[$A->id,$A->companyId]) }}" > 
                                @method('PUT')
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
                                            <input type="text" name="username" class="form-control" value="{{ $A->username }}" placeholder="Usuario">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <p>
                                        <b>* Email</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">mail</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="username" name="emailuser" id="emailUserS"  class="form-control"
                                                    value="{{ $A->emailuser }}" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                    <p>
                                        <b>* Telefono</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">phone</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="phoneNumber" id="phoneNumberCS" class="form-control mobile-phone-number"
                                                value="{{ $A->phoneNumber }}" placeholder="Telefono">
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
                                            <i class="material-icons">person</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="firstName" id="firstNameS"  class="form-control"
                                                value="{{ $A->firstName }}" placeholder="Nombres">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        <b>Apellidos</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="lastName" id="lastNameS"  class="form-control"
                                                value="{{ $A->lastName }}" placeholder="Apellidos">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                </div>
                                
                            </div>
                            <h5>Solo se mostrar los datos de la compañia:</h5> 
                            <h2 class="card-inside-title">Datos del compañia</h2>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Compañia</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">business</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="name" id="nameCS" class="form-control" value="{{ $A->name }}" readonly="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        <b>Dirreccion</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">my_location</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="address" id="addressCS" class="form-control" value="{{ $A->address }}" placeholder="Dirreccion" readonly="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        <b>Email de la Compañia</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">mail</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text"  name="emailcompany" id="emailcompanyCS" class="form-control"
                                                value="{{ $A->emailcompany }}" readonly="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        <div class="row clearfix">
                                           <div class="col-sm-10"></div>
                                           <div class="col-sm-2">
                                                <button class="btn btn-info">Guardar</button>
                                           </div>
                                        </div>
                                        </td>
                                    </tr>
                                      
                                    </form>
                                @endforeach

                        </div>
                    </div>
            </div>
        </div>
<script type="text/javascript">
    $("#Administradores").addClass('active');
    $("#MostrarAdmins").addClass('active');
</script>

@endsection
