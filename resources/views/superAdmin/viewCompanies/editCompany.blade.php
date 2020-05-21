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
                                @method('PUT')
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
                                            <input type="text" name="email" id="firstNameS"  class="form-control"
                                                value="{{ $A->email }}" placeholder="Nombres">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                
                                <div class="col-sm-8">
                                    <p>
                                        <b>* Dirreccion</b>
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


<script type="text/javascript">
    $("#Company").addClass('active');
    $("#CompanySee").addClass('active');



    $("#btn-form").click(function(){
        swal({
          title: "Atención",
          text: "Se actualizara los datos de esta compañia ,¿Estas seguro?",
          icon: "warning",
          buttons: ["Cancelar", "Si"],
          dangerMode: true
        })
        .then((willDelete) => {

            if (willDelete) {
                let name = $("input[name=name]").val();
                let email = $("input[name=email]").val();
                let address = $("input[name=address]").val();
                let phoneNumber = $("input[name=phoneNumber]").val();
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "/superAdmin/viewCompanies/editCompany/showSA/"+$("input[name=Id]").val(),
                    type:"POST",
                    data:{
                      name:name,
                      email:email,
                      address:address,
                      phoneNumber:phoneNumber,
                      _token: _token
                    },

                    success:function(response){
                      swal("Actualización", "Se ha actulizado los datos correctamente!", "success");
                    },
                    error:function(response){
                        console.log(response);
                      swal("Error", "Verifique los datos antes de actualizar", "error");
                    }
                   });

            }
           
        });

    });


</script>


@endsection
