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

<style type="text/css">
input[type="file"] {
    display: none;
}

</style>
<div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                       <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 24px;">assignment_turned_in</i>
                            Evaluación 
                        </div>
                        <div class="body">
                            Usuario! para subir sus evidencias haga clic en "Subir Archivo" y luego para enviala haga clic "Enviar".
                            <h6><b>Prueba: {{ $Test->name }} <br> Usuario: {{ $User->firstName." ".$User->lastName }}</b></h6>
                                                   
                                    
                                @foreach ($Datos as $D)
                                    <div class="row clearfix">
                                        <div class="col-sm-1">
                                        </div>
                                        <div class="col-sm-7">
                                            <p style="background: #eeeeee;">
                                                <b>{{ $D['Nivel'] }} </b>
                                            </p>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-addon">
                                                    @if ($D['Verifica'] == 1)
                                                        <i class="material-icons" style="color:green;">done_outline</i>
                                                    @else
                                                        @if ($D['Verifica'] == 2)
                                                        <i class="material-icons">find_in_page</i>
                                                        @else
                                                            <i class="material-icons">bookmark</i> 
                                                        @endif
                                                    @endif
                                                </span>
                                                <div class="form" >
                                                     <input type="text" class="form-control" name="Attribute{{ $i }}" value="{{ $D['AtributoName'] }}" readonly style="border: 0px;">
                                                </div>
                                            </div>
                                            @if ($D['Comment'] != "")                                                        
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">sms</i>
                                                </span>
                                                <div class="form">
                                                         <input type="text" class="form-control" name="Coment{{ $i }}" value="{{ $D['Comment'] }}" readonly style="border: 0px;">
                                                </div>
                                            </div>
                                            @endif
                                        @error('file'.$i)
                                            <div class="alert alert-warning alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    No se ha enviado el archivo, intente de nuevo por favor... 
                                            </div>
                                        @enderror
                                        </div>                                    
                                <form  action="/upload" id="form" method='POST' enctype="multipart/form-data">
                                @csrf
                                        <div class="col-sm-2">
                                           <center>
                                                <label for="file{{ $i }}" class="btn btn-success">
                                                    <i class="material-icons">backup</i> <span id="A{{ $i }}"> Subir archivo</span>
                                            </label>
                                            <input type="file" id="file{{ $i }}" onchange='cambiar({{ $i }})' name="file{{ $i }}">
                                            <br>
                                            <input type="hidden" name="valor" value="{{ $i }}">
                                            <input type="hidden" name="attributeId{{ $i }}" value="{{ $D['AtributoId'] }}">
                                           </center>
                                        </div>
                                        <div class="col-sm-1">
                                            <center>
                                                <button class="btn btn-primary">
                                                <i class="material-icons">send</i> <span>Enviar</span>
                                            </button>
                                            </center>
                                        </div>
                                    </div>
                              </form>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach  
                        </div>
                    </div>
            </div>
</div>

<script type="text/javascript">
    function cambiar(i){
    var pdrs = document.getElementById('file'+i).files[0].name;
    document.getElementById('A'+i).innerHTML = pdrs;
}

</script>

@if (session()->has('success'))
    <script type="text/javascript">
    swal("Listo!", "Se ha subir con exito el archivo", "success");
    </script>
@endif

    
@endsection
