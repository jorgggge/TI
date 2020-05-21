@extends('layouts.app')

@section('content')
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 20px;">edit</i>
                            Editar Administrador
                        </div>
                        <div class="body">
                            
                            <b>Llena los campos con los datos de Administrador: <br> (*) Datos Obligatorios</b> 
                            <h2 class="card-inside-title">Datos del Administrador</h2>
                            @foreach ($Admin as $A)
                            <form id="from" method="POST" action="{{ route('UpdateCustomer',[$A->id,$A->companyId]) }}" > 
                                <input type="hidden" name="id_u" value="{{ $A->id }}">
                                <input type="hidden" name="id_c" value="{{ $A->companyId }}">
                                @method('PUT')
                                @csrf
                            <div class="row clearfix">
                                <div class="col-sm-6">
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
                                 <div class="col-sm-6">
                                    <p>
                                        <b>* Email</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">mail</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="emailuser" name="emailuser" id="emailUserS"  class="form-control"
                                                    value="{{ $A->emailuser }}" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                <div class="col-sm-6">
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
                                <div class="col-sm-6">
                                    <p>
                                        <b>* Apellidos</b>
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
                            <b>Solo se mostrar los datos de la compañia:</b> 
                            <h2 class="card-inside-title">Datos del compañia</h2>
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <p>
                                        <b>Compañia</b>
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
                                        <b>Telefono de la compañia</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">phone</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="phoneNumber" id="phoneNumberCS" class="form-control mobile-phone-number"
                                                value="{{ $A->phoneNumber }}" placeholder="Telefono" readonly="true">
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

                                <div class="col-sm-8">
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
                            </div>
                                        
                                      
                                      
                                    </form>
                                @endforeach
                        <div class="row clearfix">
                            <div class="col-sm-10"></div>
                            <div class="col-sm-2">
                                <button class="btn btn-primary waves-effect" id="btn-form">
                                    <i class="material-icons">done</i> <span> Actualizar </span> 
                                </button>
                            </div>
                        </div>  
                    </div>
                    </div>
            </div>
        </div>
<script type="text/javascript">
    $("#Administradores").addClass('active');
    $("#MostrarAdmins").addClass('active');

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
                let username = $("input[name=username]").val();
                let lastName = $("input[name=lastName]").val();
                let firstName = $("input[name=firstName]").val();
                let emailuser = $("input[name=emailuser]").val();
                let name = $("input[name=name]").val();
                let address = $("input[name=address]").val();
                let phoneNumber = $("input[name=phoneNumber]").val();
                let emailcompany = $("input[name=emailcompany]").val();
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "/superAdmin/viewcustomersuperadmin/update/"+$("input[name=id_u]").val()+"/"+$("input[name=id_c]").val(),
                    type:"POST",
                    data:{
                        username:username,
                        lastName:lastName,
                        firstName:firstName,
                        emailuser:emailuser,
                        name:name,
                        address:address,
                        phoneNumber:phoneNumber,
                        emailcompany:emailcompany,
                        _token:_token
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
