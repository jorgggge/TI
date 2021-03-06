@extends('layouts.app')

@section('content')


<div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 20px;">group_add</i>
                            Nueva compañía
                        </div>
                        <div class="body">
                                    <b>Llena los campos con los datos de la nueva compañía: <br> (*) Datos Obligatorios</b>
                            <h2 class="card-inside-title">Datos de la Compañía</h2>
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
                                        @error('name')
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                Verifique el nombre
                                            </div>
                                        @enderror
                                </div>
                                 <div class="col-sm-4">
                                    <p>
                                        <b>* Teléfono</b>
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
                                        @error('phoneNumber')
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                Verifique el numero de teléfono
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
                                            <input type="email" name="email" id="firstNameS"  class="form-control"
                                               placeholder="Email" required value="{{ old('email') }}">
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
                                
                                <div class="col-sm-10">
                                    <p>
                                        <b>* Dirección</b>
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
                                        @error('address')
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                Verifique la dirección 
                                            </div>
                                        @enderror
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


@if ($errors->any())
    <script type="text/javascript">
         swal("Error", "Verifique los datos antes de guardar", "error");
    </script>
@endif



@endsection
