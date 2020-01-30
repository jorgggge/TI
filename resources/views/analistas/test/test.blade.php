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
                            <a href="{{route('analistaTest',[$concept->testId,$concept->conceptId])}}">
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
                    <div class="Customer">
                        <div class="card-header">
                            <p>{{$test['name']}}</p>
                        </div>
                        <div class="card-body">
                            <form method="post" action="/test">
                                <input type="hidden" name="email" value="{{$email}}">
                                <input type="hidden" name="commonUserId" value="{{$commonUserId}}">
                                <input type="hidden" name="username" value="{{$name}} {{$lastName}}">
                                <input type="hidden" name="testName" value="{{$testName}}">
                                @csrf
                                <table>
                                    <thead>
                                    <tr class='heady'>
                                        <th class='bold' id="address addy" scope="col">Usuario: {{$name}} {{$lastName}}</th>
                                        <th class='bold' id="address addy" scope="col">Correo: {{$email}}</th>
                                    </tr>
                                    </thead>
                                </table>
                                <table>
                                    <thead>
                                    <tr class='heady'>
                                        <th class='bold' id="address addy" scope="col">Atributos</th>
                                        <th class='bold' id="address addy" scope="col">Descargar</th>
                                        <th class='bold' id="address addy" scope="col">Validar</th>
                                    </tr>
                                    </thead>
                                        @foreach($maturityLevels as $maturityLevel)
                                            <tr class='heady'>
                                                <th class='' id="address addy" >
                                                    <p class="font-weight-bold">{{$maturityLevel->description}}</p>
                                                </th>
                                            </tr>
                                            @foreach($attributes as $attribute)
                                                @if($attribute->conceptMLId == $maturityLevel->conceptMLId)
                                                    <tr class="border">
                                                        <td>{{$attribute->description}}</td>
                                                        <input type="hidden" name="attribute-name[]" value="{{$attribute->attributeId}}">
                                                    @for($i=0;$i < sizeof($attributesWithEvidences);$i++)
                                                        @if($attribute->attributeId == $attributesWithEvidences[$i]->attributeId)
                                                                <td><a href="/storage/upload/{{$attributesWithEvidences[$i]->link}}" class="btn"><div><i class="material-icons">cloud_download</i></div></a></td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <label
                                                                            for="attributeCheck{{$attributesWithEvidences[$i]->attributeId}}">
                                                                        </label>
                                                                        <input type="hidden"  name="attributeCheck[{{$attributesWithEvidences[$i]->attributeId}}]" value="off" >
                                                                        <input type="checkbox" class="form-check-input" name="attributeCheck[{{$attributesWithEvidences[$i]->attributeId}}]" id="attributeCheck{{$attributesWithEvidences[$i]->attributeId}}"
                                                                               @if($attributesWithEvidences[$i]->verified === 1)
                                                                               checked
                                                                        @else
                                                                            @endif>
                                                                        <label class="form-check-label" for="exampleCheck1">Validar evidencia</label>
                                                                    </div>
                                                                </td>
                                                            @endif
                                                        @endfor
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                </table>
                                <div class="offset-sm-3 col-sm-9">
                                    @if(count($attributesWithEvidences) == 0)
                                        <button type="submit" class="btn btn-primary" hidden>Confirmar</button>
                                    @else
                                        <button type="submit" class="btn btn-primary">Confirmar</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
