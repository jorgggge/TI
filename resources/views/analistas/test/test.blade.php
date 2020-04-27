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
                            <h3> Prueba: {{$test['name']}} <br> Concepto: {{$selectedConcept['description']}}</h3>
                     
                            <form method="post" action="/test">
                                <input type="hidden" name="email" value="{{$email}}">
                                <input type="hidden" name="commonUserId" value="{{$commonUserId}}">
                                <input type="hidden" name="username" value="{{$name}} {{$lastName}}">
                                <input type="hidden" name="testName" value="{{$testName}}">
                                @csrf
                               <blockquote class="blockquote-reverse"> <h4> Usuario: {{$name}} {{$lastName}}<br> Correo: {{$email}}</h4>   </blockquote>
                                 @foreach($maturityLevels as $maturityLevel)
                                                <h3> Nivel: {{$maturityLevel->description}}</h3>
                                        @foreach($attributes as $attribute)
                                        <div class="row clearfix">
                                                @if($attribute->conceptMLId == $maturityLevel->conceptMLId)
                                                 <div class="col-sm-1"></div>
                                                    <div class="col-sm-4"> 
                                                             <h4> <i class="material-icons">bookmark</i>{{$attribute->description}}</h4>

                                                        <input type="hidden" name="attribute-name[]" value="{{$attribute->attributeId}}">
                                                    </div>
                                                        
                                                    @for($i=0;$i < sizeof($attributesWithEvidences);$i++)
                                                        @if($attribute->attributeId == $attributesWithEvidences[$i]->attributeId)
                                                                <div class="col-sm-2">
                                                                    <a href="/storage/app/public/upload/{{$attributesWithEvidences[$i]->link}}" class="btn btn-primary"><div><i class="material-icons">cloud_download</i> Ver</div></a>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <input type="checkbox"  name="attributeCheck[{{$attributesWithEvidences[$i]->attributeId}}]" id="attributeCheck{{$attributesWithEvidences[$i]->attributeId}}"
                                                                           @if($attributesWithEvidences[$i]->verified === 1)
                                                                           checked
                                                                    @else
                                                                        @endif>
                                                                    <label class="form-check-label" for="attributeCheck{{$attributesWithEvidences[$i]->attributeId}}">Validar evidencia</label>
                                                                </div>
                                                            @endif
                                                        @endfor
                                                    </tr>
                                                @endif
                                            
                                        </div>
                                        @endforeach
                                @endforeach    
                                <div class="row clearfix">
                                    <div class="col-sm-10"></div>
                                    <div class="col-sm-2">
                                        @if(count($attributesWithEvidences) == 0)
                                            <button type="submit" class="btn btn-primary" hidden>Confirmar</button>
                                        @else
                                            <button type="submit" class="btn btn-primary">Confirmar</button>
                                        @endif
                                    </div>
                                </div>   
                            </form>
                        </div>
                    </div>
            </div>
</div>

    @endif
@endsection
