@extends('layouts.app')
@section('content')
<div class="container mt-1">
    <div class="dropdown">
        <button class="btn dropdown-toggle dp-areas" type="button" id="dropdownMenu2" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" style="}">
            {{$areaSeleccionada->name}}
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            @foreach($areas as $area)
            <a href="{{route('analistaViewResults',$area['areaId'])}}">
                <button class="dropdown-item " type="button">{{$area['name']}}
                </button>
            </a>
            @endforeach
        </div>
    </div>
</div>
@foreach($tests as $test)
<div class="container-fluid m-sm-auto bg-light flow">
    <div class="row justify-content-center bot">
        <div class="col-10 max">
            <h1 class="text-center font-weight-bold">{{$test['name']}}</h1>
            <div class="row bg-transparent rounded mb-0 column" style="">
                <div class="col-xl-6 max my-auto ">
                    <div class="row row2 ">
                        <table class="result table-light table-striped table-hover">
                            <thead class="thead-marine" style=".thead-marine">
                                <tr>
                                    <th scope="col">Concepto</th>
                                    <th scope="col">Puntuaje</th>
                                    <th scope="col">Nivel de Madurez</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach((array)$testsConcepts as $testConcept)

                                    @if($testConcept->testId == $test['testId'])
                                        <tr>
                                            <th>{{$testConcept->description}}</th>
                                            <th>{{$results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']}}</th>
                                            <th>
                                                @if($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']===0)
                                                    Test por terminar de completar...
                                                @endif
                                                @switch($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)'])

                                                    @case($results[array_search($testConcept,$testsConcepts)]['COUNT(evidenceID)']<3)
                                                        @foreach($maturityLevels as $item)
                                                            @if($item['level']==1)
                                                                {{$item['description']}} ]
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
                                            </th>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row2 col-xl-6 max my-auto ">
                    <div class="card bg-transparent" style="border: none; ">
                        <div class="card-body">
                            <div class="chart" *ngIf="showchart">
                                <canvas id="myChart{{array_search($test,$tests)}}"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endforeach
    @endsection
    @section('script')
        <script>
                @foreach($tests as $test)
            var ctx = document.getElementById("myChart{{array_search($test,$tests)}}");
            var lineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        @foreach((array)$testsConcepts as $testConcept)
                            @if($testConcept->testId == $test['testId'])
                            "{{$testConcept->description}}",
                        @endif
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
