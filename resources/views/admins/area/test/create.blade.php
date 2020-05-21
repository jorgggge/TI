@extends('layouts.app')

@section('content')


<div class="container-fluid">
            <div class="row clearfix">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 24px;">assignment</i>
                            Nueva Prueba 
                            
                        </div>
                        <div class="body">
                            <b>Llena los campos con los datos de la nueva prueba: <br> (*) Datos Obligatorios</b><br>
                            <form id="form" method="POST" action="/createTest/admins">
                                @csrf
                            <h2 class="card-inside-title"></h2>
                            <div class="row clearfix">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-5">
                                     <p>
                                        <b>* Nombre de la prueba</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">assignment</i>
                                        </span>
                                        <div class="form-line">
                                           <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" placeholder="Nombre de la prueba">
                                           @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                     <p>
                                        <b>* Asingar concepto</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">assignment</i>
                                        </span>
                                        <div class="form-line">
                                           <input id="concept" type="text"
                                                class="form-control @error('concept') is-invalid @enderror"
                                                name="concept" required autocomplete="concept" placeholder="Concepto">

                                            @error('concept')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-1"></div>
                                    <div class="col-sm-5">
                                    <b>* Asignar Area</b>
                                    <select  type='text' required id="area"
                                                    class="form-control show-tick @error('area') is-invalid @enderror"
                                                    name="area">
                                                    @foreach($areas as $area)
                                                    <option value="{{ $area->areaId }}" selected>{{ $area->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('area')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                </div>
                            </div>

                                    @foreach($maturity_levels as $maturity)
                                           
                                    @if($maturity->level == 1)
                                    @foreach(range(0,2) as $x)
                                    <div class="row clearfix">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-10">
                                            <p>
                                                <b>Nivel de Madurez: {{$maturity->description}}<br> * Atritubo</b>
                                            </p>
                                             <div class="input-group input-group-lg">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">bookmark</i>
                                                </span>
                                                <div class="form-line">
                                                     <input type="text"
                                                    class="form-control @error('attribute') is-invalid @enderror"
                                                    name="muy_bajo[{{$x}}]" required autocomplete="muy_bajo[{{$x}}]" placeholder="Escriba aqui">

                                                @error('attribute')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    @if($maturity->level == 2)
                                    @foreach(range(0,2) as $x)
                                         <div class="row clearfix">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-10">
                                            <p>
                                                <b>Nivel de Madurez: {{$maturity->description}}<br> * Atritubo</b>
                                            </p>
                                             <div class="input-group input-group-lg">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">bookmark</i>
                                                </span>
                                                <div class="form-line">
                                                     <input type="text"
                                                class="form-control @error('attribute') is-invalid @enderror"
                                                name="bajo[{{$x}}]" required autocomplete="bajo[{{$x}}]"  placeholder="Escriba aqui">

                                            @error('attribute')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    @if($maturity->level == 3)
                                    @foreach(range(0,2) as $x)
                                       <div class="row clearfix">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-10">
                                            <p>
                                                <b>Nivel de Madurez: {{$maturity->description}}<br> * Atritubo</b>
                                            </p>
                                             <div class="input-group input-group-lg">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">bookmark</i>
                                                </span>
                                                <div class="form-line">
                                                     <input type="text"
                                                class="form-control @error('attribute') is-invalid @enderror"
                                                name="intermedio[{{$x}}]" required autocomplete="intermedio[{{$x}}]"  placeholder="Escriba aqui">

                                            @error('attribute')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    @if($maturity->level == 4)
                                    @foreach(range(0,2) as $x)
                                    <div class="row clearfix">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-10">
                                            <p>
                                                <b>Nivel de Madurez: {{$maturity->description}}<br> * Atritubo</b>
                                            </p>
                                             <div class="input-group input-group-lg">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">bookmark</i>
                                                </span>
                                                <div class="form-line">
                                                     <input type="text"
                                                class="form-control @error('attribute') is-invalid @enderror"
                                                name="alto[{{$x}}]" required autocomplete="alto[{{$x}}]"  placeholder="Escriba aqui">

                                            @error('attribute')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    @if($maturity->level == 5)
                                    @foreach(range(0,2) as $x)
                                    <div class="row clearfix">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-10">
                                            <p>
                                                <b>Nivel de Madurez: {{$maturity->description}}<br> * Atritubo</b>
                                            </p>
                                             <div class="input-group input-group-lg">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">bookmark</i>
                                                </span>
                                                <div class="form-line">
                                                     <input type="text"
                                                class="form-control @error('attribute') is-invalid @enderror"
                                                name="muy_alto[{{$x}}]" required autocomplete="muy_alto[{{$x}}]"  placeholder="Escriba aqui">

                                            @error('attribute')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    @endforeach

                                
                        </form>
                                <div class="row clearfix">
                                    <div class="col-sm-10"></div>
                                    <div class="col-sm-2">
                                        <center>
                                            <button id="btn-form" class="btn btn-primary">
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
    $("#AgregarPrueba").addClass('active');


    $("#btn-form").click(function(){
        swal({
          title: "Atención",
          text: "Se ingresaran una nueva prueba,¿Estas seguro?",
          icon: "warning",
          buttons: ["Cancelar", "Si"],
          dangerMode: true
        })
        .then((willDelete) => {

            if (willDelete) {

                $ $( "input[type='text']" ).each(function() {
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
                    swal("Espero un momento!", {
                      buttons: false,
                    });
                }else{
                    swal("Error", "Verifique los datos antes de actualizar", "error");
                }
            }
           
        });

    });
</script>
@endsection
