@extends('layouts.app')

@section('content')


<div class="container-fluid">
            <div class="row clearfix">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                            <i class="material-icons" style="font-size: 24px;">edit</i> Editar Prueba
                        </div>
                        <div class="body">
                                 <div class="row clearfix">
                                    <div class="col-sm-8">
                                        Ingresa el nombre nuevo de esta prueba y/o asigna usuario a esta pruebas.<br> 
                                        <b>(*) Datos Obligatorios</b>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-4">
                                    <p>
                                        <b>* Nombre de la prueba</b>
                                    </p>

                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">assignment_turned_in</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" required value="{{ $testname }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-4">
                                        <b >Usuarios Asignados:</b>
                                        <br>
                                        @php
                                            $contador = 1;
                                        @endphp
                                        @foreach ($users as $user)
                                        @php
                                            $validar = 0;
                                        @endphp
                                            <br>
                                            @foreach ($test_users as $tc)

                                                    @if ($user->userId == $tc->userId && $validar == 0)
                                                        <input class="lever" type="checkbox" id="check{{ $contador }}" name="" value="{{ $user->userId }}" checked>
                                                        <label for="check{{ $contador }}">
                                                            {{ $user->firstName." ".$user->lastName }}
                                                        </label>
                                                    @php
                                                        $validar = 1;
                                                    @endphp

                                                    @endif
                                            @endforeach
                                            @if ($validar == 0)
                                                 <input class="lever" type="checkbox" id="check{{ $contador }}" name="" value="{{ $user->userId }}" >
                                                <label for="check{{ $contador }}">
                                                    {{ $user->firstName." ".$user->lastName }}
                                                </label>
                                            @endif

                                        @php
                                            $contador++;
                                        @endphp
                                        @endforeach
                                    </div>
                                    <div class="col-sm-2">
                                       <center>
                                            <button type="submit" id="btn-form2" class="btn btn-primary">
                                            <i class="material-icons">done</i> <span>Guardar</span> 
                                        </button>
                                       </center>
                                    </div>
                                </div> 
                            @include('errors')
                        </div>
                    </div>
                </div>
        </div>
    </div>


<script type="text/javascript">


    $("#Pruebas").addClass('active');
    $("#MostrarPruebas").addClass('active');


    $('#btn-form2').click(function() {

        swal({
              title: "Alerta",
              text: "Se actualizara los datos de esta prueba,¿Estas seguro?",
              icon: "warning",
              buttons: true,
              dangerMode: true
            })
            .then((willDelete) => {
                if (willDelete) {
                $( "input[type='text']" ).each(function() {
                    $( this ).css('border-color','#1F91F3');
                });
                let name = $('#name').val();

                if(name != null && name != ""){
                    $.ajax({
                          type: "GET",
                          url: "/Test_User/"+{{ $testId }}+"/"+name,
                          success: function(response){
                            swal("Actualización", "Se ha actulizado los datos correctamente!", "success");
                          },
                          error:function(response){
                          swal("Error", "Verifique los datos antes de actualizar", "error");
                        }
                    });
                }else{
                    $( "input[type='text']" ).each(function() {
                    $( this ).css('border-color','red');
                    });
                    swal("Error", "Verifique los datos antes de actualizar", "error");
                }

              } 
            });

        
    });

    $("input[type='checkbox']").change(function() {
        var $input = $(this);
        
        var check =  $input.is(":checked") ? 1 : 0;

        $.ajax({
              type: "GET",
              url: "/Test_User/"+{{ $testId }}+"/"+$input.val()+"/"+check,
              success: function(response){}
        });

    }).change();


    

</script>

@endsection
