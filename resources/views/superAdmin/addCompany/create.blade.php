@extends('layouts.app')

@section('content')


<div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 20px;">group_add</i>
                            Nueva compañia
                        </div>
                        <div class="body">
                                    <b>Llena los campos con los datos de la nueva compañia: <br> (*) Datos Obligatorios</b>
                            <h2 class="card-inside-title">Datos de la Compañia</h2>
                            <form id="from" method="POST" action="{{ route('NewCompany') }}"> 
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
                                            <input type="text" name="name" class="form-control" placeholder="Nombre" required value="{{ old('name') }}">
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
                                                 placeholder="Telefono" required value="{{ old('phoneNumber') }}">
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
                                            <input type="text" name="email" id="firstNameS"  class="form-control"
                                               placeholder="Email" required value="{{ old('email') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                
                                <div class="col-sm-10">
                                    <p>
                                        <b>* Dirreccion</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">my_location</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="address" id="lastNameS"  class="form-control"
                                                 placeholder="Dirreccion" required value="{{ old('address') }}">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                                        <div  class="row clearfix">
                                            <div class="col-sm-10"></div>
                                            <div class="col-sm-2">
                                                <center>
                                                    
                                                <button class="btn btn-info">
                                                    <i class="material-icons">mode_edit</i> <span>Guardar</span> 
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
    $("#Company").addClass('active');
    $("#CompanyAdd").addClass('active');
</script>


@if (session()->has('success'))
    <script type="text/javascript">
    swal("Listo!", "Se ha ingresado una nueva compañia!", "success");
    </script>
@endif

@if ($errors->any())
    <script type="text/javascript">
         swal("Error", "Verifique los datos antes de guardar", "error");
    </script>
@endif



@endsection
