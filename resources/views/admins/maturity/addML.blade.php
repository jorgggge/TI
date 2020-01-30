@extends('layouts.app')

@section('content')
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    </head>
    <body class="Body_SupAdmin">
    <main class="py-4 py-5-mod">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Agregar Niveles de Madurez de la Empresa</div>
                        <div class="card-body">
                            <form name="addML" id="addML" method="POST" action="/admins/index">
                                @csrf
                                @foreach(range(0,4) as $x)
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
                                <div class="input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Nivel de Madurez {{$label}}</span>
                                    </div>
                                    <input id="description-[{{$x}}]" type="text"
                                           class="form-control @error('description[{{$x}}]') is-invalid @enderror" name="description[{{$x}}]"
                                           required autocomplete="description[{{$x}}]" autofocus>

                                    @error('description[{{$x}}]')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @endforeach
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-5">
                                        <button type="submit" class="btn btn-add btn-primary">Agregar</button>
                                    </div>
                                </div>
                            </form>
                            @include('errors')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </body>
@endsection
