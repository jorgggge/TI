@extends('layouts.app')
@section('content')
{{-- 
    @if(empty($maturityLevels) || empty($attributes))
        <div class="container">
            <div class="row justify-content-center alert-warning">
                <h1 class="alert-danger">Test en proceso de creación.</h1>
            </div>
        </div>
    @else --}}


<div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                       <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 24px;">assignment_turned_in</i>
                            Evaluación 
                        </div>
                        <div class="body">
                            Verifica las evidencia subidas por el usuario asignado a esta prueba.
                            <h6><b>Prueba: {{ $Test->name }} <br> Usuario: {{ $User->firstName." ".$User->lastName }}</b></h6>
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        <div class="col-sm-7">
                                           Primer elige el Concepto: 
                                            <select name="Concepts" class="form-control show-tick">

                                                
                                                @foreach ($Concepts as $Concept)
                                                    <option value="{{ $Concept->conceptId }}" selected>{{ $Concept->description}}</option>
                                                @endforeach
                                            </select>   
                                        </div>
                                    </div>               
                                @for ($i = 1; $i < 16; $i++)
                                    <div class="row clearfix">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-7">
                                            <p style="background: #eeeeee;">
                                                <b id="N{{ $i }}"></b>
                                            </p>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">bookmark</i>
                                                </span>
                                                <div class="form" >
                                                     <input type="text" class="form-control" id="Attribute{{ $i }}" readonly style="border: 0px;" value="----------------">
                                                </div>
                                            </div>
                                            <div id="M{{ $i }}" class="input-group input-group-lg">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">sms</i>
                                                </span>
                                                <div class="form-line">
                                                     <input type="text" class="form-control" id="Coment{{ $i }}" name="Coment{{ $i }}" placeholder="Comentario ...">
                                                </div>
                                                <span class="input-group-addon" onclick="Comentario({{ $i }})" style="cursor: pointer;">
                                                    <button class="btn btn-info">
                                                        <i class="material-icons" style="color:white;">send</i>
                                                    </button>    
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <input class="form-check-input" type="checkbox" id="Check{{ $i }}" name="Check{{ $i }}">
                                            <label class="form-check-label" for="Check{{ $i }}">
                                                Verificar
                                            </label>  
                                        </div>                                    
                                        <div class="col-sm-1">
                                            <input type="hidden" id="H{{ $i }}" value="">
                                            <button id="btn{{ $i }}" onclick="Ver({{ $i }});" class="btn btn-primary">
                                                <i class="material-icons">cloud_download</i> <span>Ver evidencia</span>
                                            </button>
                                        </div>                                        
                                    </div>
                                @endfor   
                        </div>
                    </div>
            </div>
</div>

<script type="text/javascript">

    function Comentario(i) {
        if($("#Coment"+i).val() != "" && $("#Coment"+i).val() != null){

            $.ajax({
              type: "GET",
              url: "/Comentario/Evidences/"+$("#Check"+i).val()+"/"+$("#Coment"+i).val(),
              success: function(response){
                 swal("Listo!", "Se ha enviado el comentario", "success");
              }
        });
        }
    }

    function Ver(num) {
        window.location = '/download/'+$("#H"+num).val();
    }

    $("input[type='checkbox']").change(function() {
        var $input = $(this);
        
        var check =  $input.is(":checked") ? 1 : 0;

        $.ajax({
              type: "GET",
              url: "/Validar/Evidences/"+$input.val()+"/"+check,
              success: function(response){}
        });

    }).change();


    $( "select" ).change(function () {
        var str = $( "select option:selected" ).val();
        var Evidence;
        
        $.ajax({
            url: '/Analista/Prueba/Concepts/Evidences/'+str+'/'+{{ $User->id }},
            type: 'GET',
            success:function(response){
                Evidence = JSON.parse(response); 
                

            },
            error:function(response){

            }
        });

        $.ajax({
            url: '/Analista/Prueba/Concepts/Attributes/'+str,
            type: 'GET',
            success:function(response){
                swal({
                title: "Espero un momento ...",
                text: "Se cerrara automaticamente",
                timer: 2000,
                buttons: false
                });
                var Attributes = JSON.parse(response); 
                
                console.log(Evidence);
                console.log(Attributes);
                for (var i = Attributes.length - 1; i >= 0; i--) {
                    $("#N"+(i+1)).text("Nivel de madurez: "+Attributes[i].Nivel);
                    $("#Attribute"+(i+1)).val(Attributes[i].description);
                    $("#btn"+(i+1)).css("display", "none");
                    $('label[for=Check'+(i+1)+']').css('display', 'none');
                    $("#Check"+(i+1)).css("display", "none");
                    $("#M"+(i+1)).css("display","none");                   
                    $("#Coment"+(i+1)).val("");
                    
                    Evidence.forEach(function(Evidences){
                        if(Attributes[i].attributeId == Evidences.attributeId){
                            $("#btn"+(i+1)).show();
                            $("#H"+(i+1)).val(Evidences.evidenceId);
                            $('label[for=Check'+(i+1)+']').show();
                            $("#Check"+(i+1)).val(Evidences.evidenceId);
                            $("#Check"+(i+1)).show();
                            $("#Check"+(i+1)).prop("checked",(Evidences.verified == 1 ? true : false));
                            $("#M"+(i+1)).show();
                        }
                    });

                    
                }
            },
            error:function(response){

            }
        });

        

      }).change();
</script>
    
@endsection
