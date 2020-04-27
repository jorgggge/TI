@extends('layouts.app')

@section('content')


<div class="container-fluid">
            <div class="row clearfix">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">Editar Prueba</h2>
                        </div>
                        <div class="body">
                            <form method="POST" action="/admin/Edit/Prueba">
                                @csrf
                                @method('PUT')
                            <h2 class="card-inside-title"></h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                     <p>
                                        <b>Nombre de la prueba</b>
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
                                <div class="col-sm-6">
                                     <p>
                                        <b>Concepto</b>
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
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                     <b>Usuario</b>
                                   <select  type='text' required id="user"
                                                class="form-control show-tick  @error('user') is-invalid @enderror" name="user">
                                                @php
                                                    $A = "";
                                                    $Validar = 1;
                                                @endphp
                                                @foreach($List_User as $user)
                                                        @if ($A != $user->area)
                                                           
                                                            @if ($Validar == 1)
                                                                <optgroup label="{{ $user->area }}">
                                                                    @php
                                                                        $Validar = 0;
                                                                    @endphp
                                                            @else
                                                             </optgroup>
                                                             <optgroup label="{{ $user->area }}">
                                                            @endif
                                                           
                                                            @php
                                                                $A = $user->area;
                                                            @endphp
                                                            <option value="{{ $user->userId }}">{{ $user->firstName }} {{ $user->lastName }}</option>
                                                        @else
                                                            <option value="{{ $user->userId }}">{{ $user->firstName }} {{ $user->lastName }}</option>
                                                        @endif
                                                @endforeach
                                            </select>
                                            @error('user')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                </div>
                                <div class="col-sm-6"></div>
                            </div>
									@php
										$contador = 1;
									@endphp
                                    @foreach( $attributes as $x)
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <p>
                                                <b>Nivel: {{$x->ML}} . <br>Atritubo:</b>
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
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-add btn-primary">Agregar</button>

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
