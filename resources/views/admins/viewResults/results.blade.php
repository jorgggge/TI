@extends('layouts.app')
@section('content')
<div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="card">
                    <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">
                                <a href="#" style="color: white;">Resultados de {{$areaSeleccionada->name}}</a>
                            </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table  class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Concepto</th>
                                    <th>Puntuaje</th>
                                    <th >Nivel de Madurez</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tests as $test)
                                @foreach((array)$testsConcepts as $testConcept)

                                    @if($testConcept->testId == $test['testId'])
                                        <tr>
                                            <td>{{$testConcept->description}}</th>
                                            <td>{{$results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']}}</td>
                                            <td>
                                                @if($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']===0)
                                                    Test por terminar de completar...
                                                @endif
                                                @switch($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)'])

                                                    @case($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']<3)
                                                        @foreach($maturityLevels as $item)
                                                            @if($item['level']==1)
                                                                {{$item['description']}} 
                                                            @endif
                                                        @endforeach
                                                        @break
                                                    @case($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']<6)
                                                        @foreach($maturityLevels as $item)
                                                            @if($item['level']==2)
                                                                {{$item['description']}}
                                                            @endif
                                                        @endforeach
                                                        @break
                                                    @case($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']<9)
                                                        @foreach($maturityLevels as $item)
                                                            @if($item['level']==3)
                                                                {{$item['description']}}
                                                            @endif
                                                        @endforeach
                                                        @break
                                                    @case($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']<12)
                                                        @foreach($maturityLevels as $item)
                                                            @if($item['level']==4)
                                                    {{$item['description']}}
                                                        @endif
                                                        @endforeach
                                                        @break
                                                    @case($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']<15)
                                                        @foreach($maturityLevels as $item)
                                                            @if($item['level']==5)
                                                                {{$item['description']}}
                                                            @endif
                                                        @endforeach
                                                        @break
                                                    @endswitch
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                 <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>    
                      




        <script>
                @foreach($tests as $test)
            var ctx = document.getElementById("myChart");
            var lineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach((array)$testsConcepts as $testConcept)
                            "{{$testConcept->description}}",
                        @endforeach
                    ],
                    datasets: [{
                        data:
                            [
                                @foreach((array)$testsConcepts as $testConcept)
                                {{$results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']}},
                                @endforeach
                            ],
                        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"],
                        borderWidth: 1,
                        scaleSteps: 10,
                        scaleStepWidth: 50,
                        scaleStartValue: 0,
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Resultados de las pruebas'
                    },
                    scales: {
                            yAxes: [{
                                ticks: {
                                    max: 15,
                                    min: 0,
                                    stepSize: 1
                                }
                            }]
                        },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: false
                    }
                }
            });
            @endforeach
        </script>

 <script>
                @foreach($tests as $test)
            var ctx = document.getElementById("myChart");
            var lineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach((array)$testsConcepts as $testConcept)
                            "{{$testConcept->description}}",
                        @endforeach
                    ],
                    datasets: [{
                        data:
                            [
                                @foreach((array)$testsConcepts as $testConcept)
                                {{$results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']}},
                                @endforeach
                            ],
                        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774","#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"],
                        borderWidth: 1,
                        scaleSteps: 10,
                        scaleStepWidth: 50,
                        scaleStartValue: 0,
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Resultados de las pruebas'
                    },
                    scales: {
                            yAxes: [{
                                ticks: {
                                    max: 15,
                                    min: 0,
                                    stepSize: 1
                                }
                            }]
                        },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: false
                    }
                }
            });
            @endforeach
        </script>
    @endsection

