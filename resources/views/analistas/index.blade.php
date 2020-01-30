@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom: 1em; margin-top: 1em;">
    <div class="row">
        <div class="btn-group-toggle">
            @if(empty($areas))
            <div class="alert alert-danger">
                {{ 'Contacta a tu administrador para que te asigne un área' }}
            </div>
            <a href="" class="ButtonAdd_SA btn border-light">
                <div><i class="material-icons">insert_chart_outlined</i></div>
                <div>Ver resultados</div>
            </a>
            @else
            <a href="{{route('analistaViewResults',$areas[0]['areaId'])}}" class="ButtonAdd_SA btn border-light">
                <div><i class="material-icons">insert_chart_outlined</i></div>
                <div>Ver resultados</div>
            </a>
            @endif

        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center analPad">
        <table class="table table-bordered table-light table-hover table-striped">
            <thead class="text-white" style="background: #1b4b72;">
            <tr>
                <th class="text-center" scope="col">ÁREA</th>
                <th class="text-center" scope="col">RESULTADOS</th>
            </tr>
            </thead>
            <tbody>
            @foreach((array)$areas as $area)
                <tr>
                    <td class="td text-center" style="font-size: large">{{$area['name']}}</td>
                    <td class="td text-center">
                        <a href="{{route('analistaViewResults',$area['areaId'])}}" class="Button_See btn"> Ver </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center analPad">
        <table class="table table-bordered table-light table-hover table-striped">
            <thead class="text-white" style="background: #1b4b72;">
            <tr>
                <th class="text-center" scope="col">NOMBRE DEL AREA</th>
                <th class="text-center" scope="col">NOMBRE DE LA PRUEBA</th>
                <th class="text-center" scope="col">NOMBRE DEL CONCEPTO</th>
                <th class="text-center" scope="col">IR A LA PRUEBA</th>
            </tr>
            </thead>
            <tbody>
            @foreach((array)$concepts as $concept)
                <tr>
                    <td class="td text-center" style="font-size: large">{{$concept->areaName}}</td>
                    <td class="td text-center" style="font-size: large">{{$concept->testName}}</td>
                    <td class="td text-center" style="font-size: large">{{$concept->description}}</td>
                    <td class="td text-center">
                        <a href="{{route('analistaTest',[$concept->testId,$concept->conceptId])}}"
                           class="Button_See btn"> Ver </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
