@extends('layouts.app')

@section('content')
<div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                            <i class="material-icons" style="font-size: 20px;">edit</i>
                            Editar Usuario
                        </div>
                        <div class="body">
                            
                            <b>Llena los campos con los datos del Usuario: <br> (*) Datos Obligatorios </b>
                            <h2 class="card-inside-title">Datos del Usuario:</h2>
                             <form id="from" method="POST" action="/admins/user_up/{[0]{$User['id']}}">
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
                                            <input type="text" name="username" class="form-control" placeholder="Usuario" required   readonly="true" value="{{ $User[0]['username'] }}">
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Nombres</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">assignment</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="firstName" required id="lastNameS"  class="form-control" placeholder="Nombres"  value="{{ $User[0]['firstName'] }}">
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
                                            <input type="text" name="lastName" id="lastNameS"  class="form-control" placeholder="Apellidos" required value="{{ $User[0]['lastName'] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                 <div class="col-sm-4">
                                     <p>
                                        <b>* Email</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="emailuser" id="lastNameS"  class="form-control" placeholder="email" required   value="{{ $User[0]['email']  }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Areas</b>
                                    </p>
                                        @php($count=0)
                                        @foreach ($Array_Areas as $UA)

                                        @if ($UA['validar'])
                                        <input class="form-check-input" type="checkbox" name="checked{{ $UA['areaId']}}"
                                            value="{{ $UA['areaId']}}" id="defaultCheck{{ $UA['areaId']}}" checked="true">
                                        @else
                                        <input class="form-check-input" type="checkbox" name="checked{{ $UA['areaId']}}"
                                            value="{{ $UA['areaId']}}" id="defaultCheck{{ $UA['areaId']}}">
                                        @endif
                                        <label class="form-check-label" for="defaultCheck{{ $UA['areaId']}}">
                                            {{ $UA['name']}}
                                        </label>
                                        <br>
                                        @endforeach
                                </div>
                            </div>  
                        </form>
                            <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                <div class="col-sm-8">
                                </div>
                                <div class="col-sm-4">
                                     <center>
                                         <button id="btn-form" class="btn btn-primary" type="submit">
                                         <i class="material-icons">done</i>
                                         <span>Guardar</span> 
                                     </button>
                                     </center>
                                </div>
                            </div>
                                       
                          

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
    $("#MostrarUsuarios").addClass('active');

    $("#btn-form").click(function(){
        swal({
          title: "Atención",
          text: "Se actualizara los datos de esta usuario ,¿Estas seguro?",
          icon: "warning",
          buttons: ["Cancelar", "Si"],
          dangerMode: true
        })
        .then((willDelete) => {

            if (willDelete) {
                
                $( "input[type='text']" ).each(function() {
                    $( this ).css('border-color','#1F91F3');
                });

                let username = $("input[name=username]").val();
                let lastName = $("input[name=lastName]").val();
                let firstName = $("input[name=firstName]").val();
                let emailuser = $("input[name=emailuser]").val();
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "/admins/user_up/"+{{$User[0]['id']}},
                    type:"POST",
                    data:{
                      username:username,
                      lastName:lastName,
                      firstName:firstName,
                      emailuser:emailuser,
                      _token: _token
                    },

                    success:function(response){
                      swal("Actualización", "Se ha actulizado los datos correctamente!", "success");
                    },
                    error:function(response){
                      var v = JSON.parse(response.responseText);

                        $.each(v.errors,function(index, value){
                            $("input[name="+index+"]").css('border-color','red');
                        });

                      swal("Error", "Verifique los datos antes de actualizar", "error");
                    }
                   });

            }
           
        });

    });

     $("input[type='checkbox']").change(function() {
        var $input = $(this);
        
        var check =  $input.is(":checked") ? 1 : 0;

        $.ajax({
              type: "GET",
              url: "/Area_User/"+{{$User[0]['id']}}+"/"+$input.val()+"/"+check,
              success: function(response){}
        });

    }).change();
</script>
@endsection