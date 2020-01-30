@extends('layouts.app')

@section('content')
    @if(empty($maturityLevels) || empty($attributes))
        <div class="container">
            <div class="row justify-content-center alert-warning">
                <h1 class="alert-danger">Test en proceso de creación.</h1>
            </div>
        </div>
    @else
        <div class="container mt-1">
            <div class="dropdown">
                <button class="btn dropdown-toggle dp-areas" type="button" id="dropdownMenu2" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" style="}">
                    {{$selectedConcept['description']}}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    @foreach($concepts as $concept)
                        @if($selectedConcept['description'] == $concept->description)
                        @else
                            <a href="{{route('comunTest',[$concept->testId,$concept->conceptId])}}">
                                <button class="dropdown-item " type="button">{{$concept->description}}
                                </button>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div>
                    <div class="Customer C">
                        <div class="card-header">
                            <p>{{$test['name']}}</p>
                        </div>
                        <div class="card-body">
                        <div class="message">
                                @if(session("success"))
                                <h4 class='alert-success' id='message'>{{session('success')}}</h4>

                                @endif
                            </div>
                                <table>
                                    @foreach($maturityLevels as $maturityLevel)
                                        <tr class='heady'>
                                            <td><p class="font-weight-bold">{{$maturityLevel->description}}</p></td>
                                        </tr>
                                        @foreach($attributes as $attribute)
                                            @if($attribute->conceptMLId == $maturityLevel->conceptMLId)
                                                <tr class="border flexy">
                                                    <td>{{$attribute->description}}</td>
                                                    <td><a href="/upload/{{$attribute->attributeId}}" class="btn" id="download{{$attribute->attributeId}}"><div><i class="material-icons">backup</i></div></a> </td>
                                                    @for($i=0;$i < sizeof($attributesWithEvidences);$i++)
                                                        @if($attribute->attributeId == $attributesWithEvidences[$i]->attributeId)
                                                            <td>
                                                                <a href="/upload/{{$attributesWithEvidences[$i]->evidenceId}}/edit">
                                                                    <button id="edit{{$attribute->attributeId}}">Reemplazar evidencia</button>
                                                                </a>
                                                            </td>
                                                            <td><a href="/storage/upload/{{$attributesWithEvidences[$i]->link}}" class="btn"><div><i class="material-icons">remove_red_eye</i></div></a></td>
                                                        @endif
                                                    @endfor
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('script')
    <script>
        @foreach($attributes as $attribute)
            var y = document.getElementById("download{{$attribute->attributeId}}");
            if (document.getElementById("edit{{$attribute->attributeId}}")) {
                y.style.visibility = "hidden";
            }
        @endforeach
    </script>
    @endsection

