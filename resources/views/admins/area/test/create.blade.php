@extends('layouts.app')

@section('content')


<div class="container-fluid">
            <div class="row clearfix">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">Nueva Prueba</h2>
                        </div>
                        <div class="body">
                            <h5>Llena los campos con los datos de la nueva prueba: <br> (*) Datos Obligatorios</h5> 
                            <h2 class="card-inside-title">Datos del Usuario:</h2>
                            <form method="POST" action="/createTest/admins">
                                @csrf
                            <h2 class="card-inside-title"></h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
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
                                <div class="col-sm-6">
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
                                <div class="col-sm-6">
                                     <b>* Asignar Usuario</b>
                                   <select  type='text' required id="user"
                                                class="form-control show-tick  @error('user') is-invalid @enderror" name="user">
                                                <option disabled selected>Selecciona el usuario
                                                </option>
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
                                <div class="col-sm-6">
                                    <b>* Asignar Area</b>
                                    <select  type='text' required id="area"
                                                    class="form-control show-tick @error('area') is-invalid @enderror"
                                                    name="area">
                                                    <option disabled selected>Selecciona área</option>
                                                    @foreach($areas as $area)
                                                    <option value="{{ $area->areaId }}">{{ $area->name }}</option>
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
                                        <h2 class="card-inside-title">Atributos del Nivel de Madurez {{$maturity->description}}</th>
                                           
                                    @if($maturity->level == 1)
                                    @foreach(range(0,2) as $x)
                                    <div class="row clearfix">
                                        <div class="col-sm-12">
                                            <p>
                                                <b>* Atritubo</b>
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
                                        <div class="col-sm-12">
                                            <p>
                                                <b>* Atritubo</b>
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
                                        <div class="col-sm-12">
                                            <p>
                                                <b>* Atritubo</b>
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
                                        <div class="col-sm-12">
                                            <p>
                                                <b>* Atritubo</b>
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
                                        <div class="col-sm-12">
                                            <p>
                                                <b>* Atritubo</b>
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
    $("#AgregarPrueba").addClass('active');
</script>
@endsection
