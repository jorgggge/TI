@extends('layouts.app')

@section('content')

<div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">
                                <a href="#" style="color: white;">Compañias</a> > Actualizacion
                            </h2>
                            <ul class="header-dropdown m-r--5">
                              
                            </ul>
                        </div>
                        <div class="body">
                            
                            <h5>Llena los campos con los datos de la compañia:< <br> (*) Datos Obligatorios</h5> 
                            <h2 class="card-inside-title">Datos de la Compañia</h2>
                            @foreach ($Admin as $A)
                            <form id="from" method="POST" action="{{  route('EditCompanySA',[$A->companyId]) }}" > 
                                @method('PUT')
                                @csrf
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Nombre</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">business</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="username" class="form-control" value="{{ $A->name }}" placeholder="Usuario">
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
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Email</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="firstName" id="firstNameS"  class="form-control"
                                                value="{{ $A->email }}" placeholder="Nombres">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Dirreccion</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">my_location</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="lastName" id="lastNameS"  class="form-control"
                                                value="{{ $A->address }}" placeholder="Apellidos">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-4">
                                </div>
                                
                            </div>
                                        <div  class="row clearfix">
                                            <div class="col-sm-10"></div>
                                            <div class="col-sm-2">
                                                <button class="btn btn-info">Guardar</button>
                                            </div>
                                        </div>
                                      
                                    </form>
                                @endforeach

                        </div>
                    </div>
            </div>
        </div>


<script type="text/javascript">
    $("#Company").addClass('active');
    $("#CompanySee").addClass('active');
</script>


@endsection
