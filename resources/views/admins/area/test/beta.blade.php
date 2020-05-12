@extends('layouts.app')

@section('content')


<div class="container-fluid">
            <div class="row clearfix">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                            <i class="material-icons" style="font-size: 24px;">edit</i> Editar Concepto
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                    <div class="col-sm-8">
                                        Ingresa el nombre nuevo de esta prueba y/o asigna usuario a esta pruebas.
                                        <br><b>(*) Datos Obligatorios</b> 
                                    </div>
                                </div>
                            <form method="POST" action="/admin/Edit/Prueba">
                                @csrf
                                @method('PUT')
                            <h2 class="card-inside-title"></h2>
                            <div class="row clearfix">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-5">
                                     <p>
                                        <b>* Nombre de la prueba:</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">assignment</i>
                                        </span>
                                        <div class="form-line">
                                        	@foreach ($test as $t)
                                        	<input type="hidden" name="testId" value="{{ $t->testId }}">
                                        	<input id="testname" type="text" class="form-control @error('name') is-invalid @enderror" name="testname" required autocomplete="name" value="{{ $t->name}}">
                                        	@endforeach
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
                                        <b>* Concepto:</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">assignment</i>
                                        </span>
                                        <div class="form-line">
                                           @foreach ($concept as $c)
                                           <input type="hidden" name="conceptId" value="{{ $c->conceptId }}">
                                           	<input id="concept" type="text"
                                                class="form-control @error('concept') is-invalid @enderror"
                                                name="concept" required autocomplete="concept" value="{{ $c->description }}">
                                           @endforeach

                                            @error('concept')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
									@php
										$contador = 1;
									@endphp
                                    @foreach( $attributes as $x)
                                    <div class="row clearfix">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-10">
                                            <p>
                                                <b>Nivel de Madurez: {{$x->ML}}  <br>* Atritubo:</b>
                                            </p>
                                             <div class="input-group input-group-lg">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">bookmark</i>
                                                </span>
                                                <div class="form-line">
                                                	<input type="hidden" name="Id{{ $contador }}" value="{{$x->attributeId}}">
                                                     <input type="text"
                                                    class="form-control @error('attribute') is-invalid @enderror"
                                                    name="Attribute{{ $contador }}" required  value="{{ $x->AD }}">

                                                @error('attribute')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                    	$contador++;
                                    @endphp
                                    @endforeach
                                    

                                
                                </form>
                                <div class="row clearfix">
                                    <div class="col-sm-10"></div>
                                    <div class="col-sm-2">
                                        <button type="submit" id="btn-form" class="btn btn-primary">
                                            <i class="material-icons">done</i> <span>Guardar</span> 
                                        </button>

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
                
                let testname = $("input[name=testname]").val();
                let testId = $("input[name=testId]").val();
                let conceptId = $("input[name=conceptId]").val();
                let concept = $("input[name=concept]").val();
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "/admin/Edit/Prueba",
                    type:"POST",
                    data:{
                        Id1: $("input[name=Id1]").val(),
                        Attribute1: $("input[name=Attribute1]").val(),
                        Id2: $("input[name=Id2]").val(),
                        Attribute2: $("input[name=Attribute2]").val(),
                        Id3: $("input[name=Id3]").val(),
                        Attribute3: $("input[name=Attribute3]").val(),
                        Id4: $("input[name=Id4]").val(),
                        Attribute4: $("input[name=Attribute4]").val(),
                        Id5: $("input[name=Id5]").val(),
                        Attribute5: $("input[name=Attribute5]").val(),
                        Id6: $("input[name=Id6]").val(),
                        Attribute6: $("input[name=Attribute6]").val(),
                        Id7: $("input[name=Id7]").val(),
                        Attribute7: $("input[name=Attribute7]").val(),
                        Id8: $("input[name=Id8]").val(),
                        Attribute8: $("input[name=Attribute8]").val(),
                        Id9: $("input[name=Id9]").val(),
                        Attribute9: $("input[name=Attribute9]").val(),
                        Id10: $("input[name=Id10]").val(),
                        Attribute10: $("input[name=Attribute10]").val(),
                        Id11: $("input[name=Id11]").val(),
                        Attribute11: $("input[name=Attribute11]").val(),
                        Id12: $("input[name=Id12]").val(),
                        Attribute12: $("input[name=Attribute12]").val(),
                        Id13: $("input[name=Id13]").val(),
                        Attribute13: $("input[name=Attribute13]").val(),
                        Id14: $("input[name=Id14]").val(),
                        Attribute14: $("input[name=Attribute14]").val(),
                        Id15: $("input[name=Id15]").val(),
                        Attribute15: $("input[name=Attribute15]").val(),
                        testname: testname,
                        testId: testId,
                        conceptId: conceptId,
                        concept: concept,
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
</script>

@endsection
