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
                                        <b>Puede cambiar el nombre de esta prueba y/o cambia los atributos  
                                        <br>(*) Datos Obligatorios</b> 
                                    </div>
                                </div>
                            <form method="POST" action="/admin/Edit/Prueba" id="form">
                                @csrf
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
                                                <b>Nivel de Madurez: {{$x->ML}}  <br>* Atributo:</b>
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
                                    

                                
                                <div class="row clearfix">
                                    <div class="col-sm-10"></div>
                                    <div class="col-sm-2">
                                        <center>
                                            <button type="submit" id="btn-form" class="btn btn-primary">
                                            <i class="material-icons">done</i> <span>Guardar</span> 
                                        </button>
                                        </center>

                                    </div>
                                </div>
                            
                                </form>
                            @include('errors')
                        </div>
                    </div>
                </div>
        </div>
    </div>


<script type="text/javascript">
    $("#Pruebas").addClass('active');
    $("#MostrarPruebas").addClass('active');
</script>

@endsection
