@extends('layouts.app')

@section('content')
<div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">
                                <a href="#" style="color: white;">Resultados</a>
                            </h2>
                        </div>
                        <div class="body">
                            @if(empty($areas))
                                <div class="alert alert-danger" >
                                    {{ 'Agrega un área para empezar a trabajar.' }}
                                </div>
                            @else
                             <div class="table-responsive">
                                    <table id="dtBasicExample" class="table table-hover">
                                        <thead> 
                                                <tr>
                                                    <th>Área</th>
                                                    <th>Resultados</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        @foreach((array)$areas as $area)
                                            <tr>
                                                <td>{{$area['name']}}</td>
                                                <td> <a href="{{route('analistaViewResults',$area['areaId'])}}" class="btn btn-primary" > Ver </a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>   
                                    </table>
                            </div>
                            @endif
                        </div>
                    </div>
            </div>
             <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color:white;">Pruebas</h2>
                        </div>
                        <div class="body">
                            @if(empty($areas))
                                <div class="alert alert-danger" >
                                    {{ 'Agrega un área para empezar a trabajar.' }}
                                </div>
                            @else
                             <div class="table-responsive">
                                    <table id="dtBasicExample" class="table table-hover">
                                        <thead> 
                                                <tr>
                                                    <th>Área</th>
                                                    <th>Prueba</th>
                                                    <th>Concepto</th>
                                                    <th>Evaluacion</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                         @foreach((array)$concepts as $concept)
                                            <tr>
                                                <td>{{$concept->areaName}}</td>
                                                <td>{{$concept->testName}}</td>
                                                <td>{{$concept->description}}</td>
                                                <td > <a href="{{route('analistaTest',[$concept->testId,$concept->conceptId])}}" class="btn btn-primary"> Ver </a> </td>
                                            </tr>
                                        @endforeach
                                        </tbody>   
                                    </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
</div>



@endsection
