@extends('layouts.app')

@section('content')
    @if(empty($maturityLevels) || empty($attributes))
        <div class="container">
            <div class="row justify-content-center alert-warning">
                <h1 class="alert-danger">Test en proceso de creación.</h1>
            </div>
        </div>
    @else


    <div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">
                                <a href="#" style="color: white;">Evaluacion</a>
                            </h2>
                        </div>
                        <div class="body">
                            <h3> Prueba: {{$test['name']}}</h3>
                                    @foreach($maturityLevels as $maturityLevel)
                                    <h3>Nivel: {{$maturityLevel->description}}</h3>
                                        @foreach($attributes as $attribute)
                                             <div class="row clearfix">
                                            @if($attribute->conceptMLId == $maturityLevel->conceptMLId)
                                                     <div class="col-sm-1"></div>
                                                    <div class="col-sm-4">
                                                        <h4> <i class="material-icons">bookmark</i>{{$attribute->description}}</h4>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <a href="/upload/{{$attribute->attributeId}}" class="btn btn-primary" id="download{{$attribute->attributeId}}"><div><i class="material-icons">backup</i></div> Subir evidencia</a> 
                                                    </div>
                                                    @for($i=0;$i < sizeof($attributesWithEvidences);$i++)
                                                        @if($attribute->attributeId == $attributesWithEvidences[$i]->attributeId)
                                                          <div class="col-sm-2">
                                                               <a href="/upload/{{$attributesWithEvidences[$i]->evidenceId}}/edit">
                                                                    <button id="edit{{$attribute->attributeId}}" class="btn btn-primary">
                                                                    <div><i class="material-icons">backup</i></div>
                                                                Reemplazar evidencia</button>
                                                                </a>
                                                          </div>
                                                              <div>
                                                                <a href="/storage/upload/{{$attributesWithEvidences[$i]->link}}" class="btn btn-info"><div><i class="material-icons">remove_red_eye</i></div> Ver evidencia</a>
                                                            </div>
                                                        @endif
                                                    @endfor
                                                </tr>
                                            @endif
                                        </div>
                                        @endforeach
                                    @endforeach
                                </table>
                        </div>
                    </div>
            </div>
</div>


    @endif

    <script>
        @foreach($attributes as $attribute)
            var y = document.getElementById("download{{$attribute->attributeId}}");
            if (document.getElementById("edit{{$attribute->attributeId}}")) {
                y.style.visibility = "hidden";
            }
        @endforeach
    </script>
    @endsection

