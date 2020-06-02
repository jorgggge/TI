@extends('layouts.app')

@section('content')
<div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 24px;">insert_chart</i>
                            Niveles de Madurez
                        </div>
                        <div class="body">
                            <b>
                                Como primer paso, por favor debe ingresar los niveles de madurez según su criterio.
                                <br> (*) Datos Obligatorios.
                            </b>

                            <form name="addML" id="form" method="POST" action="/admins/index">
                                @csrf

                                @foreach(range(0,4) as $x)   
                                <div class="row clearfix">

                                    <div class="col-sm-2"></div>
        
                                    <?php
                                        $label = $x;
                                        if($label == 0){
                                            $label = 'Muy Bajo';
                                        }
                                        else if($label == 1){
                                            $label = 'Bajo';
                                        }
                                        else if($label == 2){
                                            $label = 'Intermedio';
                                        }
                                        else if($label == 3){
                                            $label = 'Alto';
                                        }
                                        else if($label == 4){
                                            $label = 'Muy Alto';
                                        }
                                    ?>
                                    
                                    <div class="col-sm-8">
                                                <p>
                                                    <b>*Nivel de Madurez {{$label}}</b>
                                                </p>
                                                <div class="input-group input-group-lg">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">insert_chart</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input id="description-[{{$x}}]" type="text"
                                                       class="form-control @error('description[{{$x}}]') is-invalid @enderror" name="description[{{$x}}]"
                                                       required autocomplete="description[{{$x}}]" autofocus>

                                                            @error('description[{{$x}}]')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                        </div>
                                </div>
                                @endforeach 
                            </form>
                                <div class="row clearfix">
                                    <div class="col-sm-10"></div>
                                    <div class="col-sm-2">
                                        <center>
                                            <button id="btn-form_2" class="btn btn-primary">
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

    $("#btn-form_2").click(function(){
        swal({
          title: "Atención",
          text: "Se ingresaran los niveles de madurez para su compañía,¿Estas seguro?",
          icon: "warning",
          buttons: ["Cancelar", "Si"],
          dangerMode: true
        })
        .then((willDelete) => {

            if (willDelete) {

                $( "input[type='text']" ).each(function() {
                    $( this ).css('border-color','#1F91F3');
                });

                var validar = true;
                console.log(validar);
                $( "input[type='text']" ).each(function() {
                    if($(this).val() == null || $(this).val() == ""){
                        $( this ).css('border-color','red');
                        console.log($( this ));
                       validar = false;
                    }
                });

                console.log(validar);
                if(validar){
                   $( "#form" ).submit();
                      swal({
                title: "Espere un momento ...",
                text: "Se cerrara automáticamente",
                buttons: false
                });

                }else{
                    swal("Error", "Verifique los datos antes de actualizar", "error");
                }
            }
           
        });

    });
</script>
@endsection
