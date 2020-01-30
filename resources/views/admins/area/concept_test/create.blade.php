@extends('layouts.app')

@section('content')



<main class="py-4 py-5-mod">
    <div class="container contain">
        <div class="row justify-content-center">
            <section class="addArea">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <p>Agregar Conceptos a Prueba</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/conceptTest/admins">
                                @csrf
                                <table class='eval'>
                                <tr>
                                        <p class='bold' id="address addy" >Detalles de Conceptos</p>
                                    </tr>
                                    <tr class="border">
                                        <div class="input-group mb-3">
                                            <th id="area address">Prueba</th>
                                            <td >
                                                <select required id="name" type='text' class="custom-select @error('name') is-invalid @enderror"  name="test" >
                                                    <option class='min' disabled selected>Selecciona la prueba</option>
                                                    @if(count($tests) == 0)
                                                        <option class='min' value="" disabled>No hay pruebas creadas.</option>
                                                    @else
                                                        @foreach($tests as $test)
                                                            <option class='min' value="{{ $test->testId }}">{{ $test->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </div>
                                    </tr>

                                    <tr class="border">
                                        <th id="address">Concepto</th>
                                        <td> <input id="concept" type="text"
                                                    class="form-control @error('concept') is-invalid @enderror" name="concept"
                                                    required autocomplete="concept">

                                            @error('concept')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    @foreach($maturity_levels as $maturity)
                                        <tr class='heady'>
                                            <th  class='bold' id="address addy" colspan="2">Atributos del Nivel de Madurez {{$maturity->description}}</th>
                                        </tr>
                                        @if($maturity->level == 1)
                                            @foreach(range(0,2) as $x)
                                                <tr  class="border">
                                                    <th >Atributo</th>
                                                    <td> <input  type="text"
                                                                class="form-control @error('attribute') is-invalid @enderror" name="muy_bajo[{{$x}}]"
                                                                required autocomplete="muy_bajo[{{$x}}]">

                                                        @error('attribute')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if($maturity->level == 2)
                                            @foreach(range(0,2) as $x)
                                                <tr  class="border">
                                                    <th >Atributo</th>
                                                    <td> <input  type="text"
                                                                class="form-control @error('attribute') is-invalid @enderror" name="bajo[{{$x}}]"
                                                                required autocomplete="bajo[{{$x}}]">

                                                        @error('attribute')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if($maturity->level == 3)
                                            @foreach(range(0,2) as $x)
                                                <tr  class="border">
                                                    <th >Atributo</th>
                                                    <td> <input  type="text"
                                                                class="form-control @error('attribute') is-invalid @enderror" name="intermedio[{{$x}}]"
                                                                required autocomplete="intermedio[{{$x}}]">

                                                        @error('attribute')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if($maturity->level == 4)
                                            @foreach(range(0,2) as $x)
                                                <tr  class="border">
                                                    <th >Atributo</th>
                                                    <td> <input  type="text"
                                                                class="form-control @error('attribute') is-invalid @enderror" name="alto[{{$x}}]"
                                                                required autocomplete="alto[{{$x}}]">

                                                        @error('attribute')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if($maturity->level == 5)
                                            @foreach(range(0,2) as $x)
                                                <tr  class="border">
                                                    <th >Atributo</th>
                                                    <td> <input  type="text"
                                                                class="form-control @error('attribute') is-invalid @enderror" name="muy_alto[{{$x}}]"
                                                                required autocomplete="muy_alto[{{$x}}]">

                                                        @error('attribute')
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach

                                </table>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-5">
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
</main>

@endsection
