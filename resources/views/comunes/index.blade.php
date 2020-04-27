@extends('layouts.app')

@section('content')

<div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">
                                <a href="#" style="color: white;">Pruebas</a>
                            </h2>
                        </div>
                        <div class="body">

                            @if(empty($tests))
                                <div class="alert alert-danger" >
                                    <h4>Por el momento no tienes ninguna prueba asignada, contacta a tu administrador para que se asigne una.</h4>
                                </div>
                            @else
                             <div class="table-responsive">
                                    <table id="dtBasicExample" class="table table-hover">
                                        <thead> 
                                                <tr>
                                                    <th>Prueba</th>
                                                    <th>Concepto</th>
                                                    <th>Evaluacion</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        @foreach((array)$concepts as $concept)
                                                <tr>
                                                    @foreach((array)$tests as $test)
                                                        @if($test['testId'] == $concept->testId)
                                                            <td >{{$test['name']}}</td>
                                                        @endif
                                                    @endforeach
                                                    <td>{{$concept->description}}</td>
                                                    <td>
                                                        <a href="{{route('comunTest',[$concept->testId,$concept->conceptId])}}" class="btn btn-primary"> Ver </a>
                                                    </td>
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
