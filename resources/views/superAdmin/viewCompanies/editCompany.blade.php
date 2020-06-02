@extends('layouts.app')

@section('content')

<div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 20px;">edit</i>
                            Editar compañia
                        </div>
                        <div class="body">
                        Se mostrar los datos actuales de la compañia. Por favor de llena los campos.
                            <h2 class="card-inside-title">Datos de la Compañia</h2>
                            @foreach ($Admin as $A)
                            <form id="from" method="POST" action="{{  route('EditCompanySA',[$A->companyId]) }}" > 
                                @csrf
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Nombre</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <input id="Id" name="Id" type="hidden" value="{{ $A->companyId }}">
                                        <span class="input-group-addon">
                                            <i class="material-icons">business</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="name" class="form-control" value="{{ $A->name }}" placeholder="Usuario">
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
                                                value="{{ $A->phoneNumber }}" placeholder="Telefono">
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
                                                value="{{ $A->email }}" placeholder="Nombres">
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
                                
                                <div class="col-sm-8">
                                    <p>
                                        <b>* Dirección</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">my_location</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="address" id="lastNameS"  class="form-control"
                                                value="{{ $A->address }}" placeholder="Apellidos">
                                        </div>
                                    </div>
                                     @error('address')
                                            <div class="alert alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                Verifique la dirección 
                                            </div>
                                        @enderror
                                </div>
                                 <div class="col-sm-4">
                                </div>
                                
                            </div>
                                        
                                      
                                    </form>
                                @endforeach
                                <div  class="row clearfix">
                                    <div class="col-sm-8"></div>
                                    <div class="col-sm-2">
                                        <center>
                                            <button class="btn btn-primary waves-effect" id="btn-form">
                                            <i class="material-icons">done</i> <span> Actualizar </span> 
                                        </button>
                                        </center>
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>
        </div>

@if (session()->has('successUpCompany'))
      <script type="text/javascript">
    swal("Listo!", "Se ha actualizado los datos de la compañía!", "success");
    </script>
@endif

<script type="text/javascript">
    $("#Company").addClass('active');
    $("#CompanySee").addClass('active');



    $("#btn-form").click(function(){
        swal({
          title: "Atención",
          text: "Se actualizara los datos de esta compañía ,¿Estas seguro?",
          icon: "warning",
          buttons: ["Cancelar", "Si"],
          dangerMode: true
        })
        .then((willDelete) => {

            if (willDelete) {
                swal({
                title: "Espere un momento ...",
                text: "Se cerrara automaticamente",
                buttons: false
                });
                $("#from").submit();
            }
           
        });

    });


</script>


@endsection
