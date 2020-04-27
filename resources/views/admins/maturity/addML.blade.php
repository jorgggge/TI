@extends('layouts.app')

@section('content')
<div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">
                            Agregar Niveles de Madurez de la Empresa
                            </h2>
                        </div>
                        <div class="body">
                            <h5> Como primer paso, por favor debe ingresar los niveles de madurez segun su criterio.
                                <br> (*) Datos Obligatorios.</h5>

                            <form name="addML" id="addML" method="POST" action="/admins/index">
                                @csrf

                                @foreach(range(0,4) as $x)   
                                <div class="row clearfix">

                                    <div class="col-sm-2"></div>

                                    <?php
                                        $label = $x;
                                        if($label == 0){
                                            $label = 'Muy Bajo';
                                        }
                                        else if($label == 1){
                                            $label = 'Bajo';
                                        }
                                        else if($label == 2){
                                            $label = 'Intermedio';
                                        }
                                        else if($label == 3){
                                            $label = 'Alto';
                                        }
                                        else if($label == 4){
                                            $label = 'Muy Alto';
                                        }
                                    ?>
                                    
                                    <div class="col-sm-8">
                                                <p>
                                                    <b>*Nivel de Madurez {{$label}}</b>
                                                </p>
                                                <div class="input-group input-group-lg">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">insert_chart</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input id="description-[{{$x}}]" type="text"
                                                       class="form-control @error('description[{{$x}}]') is-invalid @enderror" name="description[{{$x}}]"
                                                       required autocomplete="description[{{$x}}]" autofocus>

                                                            @error('description[{{$x}}]')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                        </div>
                                </div>
                                @endforeach
                                <div class="row clearfix">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                    </div>
                                </div>
                            </form>
                            @include('errors')
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
