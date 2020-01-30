@extends('layouts.app')

@section('content')
@if(empty($tests))
    <div class="container">
        <div class="row justify-content-center">
            <h1>Por el momento no tienes ninguna prueba asignada, contacta a tu administrador para que se asigne una.</h1>
        </div>
    </div>
    @else
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 colTest">

                <table class="table table-bordered table-light table-hover table-striped">
                    <thead class="text-white" style="background: #1b4b72;">
                    <tr>
                        <th class="text-center" scope="col">NOMBRE DE LA PRUEBA</th>
                        <th class="text-center" scope="col">NOMBRE DEL CONCEPTO</th>
                        <th class="text-center" scope="col">VER PRUEBA</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach((array)$concepts as $concept)
                        <tr>
                            @foreach((array)$tests as $test)
                                @if($test['testId'] == $concept->testId)
                                    <td class="td text-center" style="font-size: large">{{$test['name']}}</td>
                                @endif
                            @endforeach
                            <td class="td text-center" style="font-size: large">{{$concept->description}}</td>
                            <td class="td text-center">
                                <a href="{{route('comunTest',[$concept->testId,$concept->conceptId])}}" class="Button_See btn"> Ver </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
@endsection
