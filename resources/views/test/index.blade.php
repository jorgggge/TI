@extends('layouts.app')

@section('content')

<div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">
                                <a href="#" style="color: white;">Subir evidencias</a>
                            </h2>
                        </div>
                        <div class="body">
                            <form action="{{url('/upload')}}" method='POST' enctype="multipart/form-data" id='form'>
                                @csrf

                                <div>
                                <h5 style='color:red;'>Tamaño Máximo del Archivo: 5mb</h5>

                                    <input name="link" id='link' type="file"
                                        class="form-control  @error('link') is-invalid @enderror"
                                        placeholder="Nombre de la empresa" aria-label="Nombre"
                                        aria-describedby="basic-addon1" required autocomplete="link" autofocus
                                        value={{Request::old('link')}}></label>
                                    @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                    @enderror

                                </div>


                                <input type="hidden" name='attributeId' value="{{$selectedAttribute['attributeId']}}"
                                    required>


                                <input type="hidden" value='0' name='verified' required>
                                @if(Auth::user())
                                <input type="hidden" value="{{$user->id}}" name='userId' required>
                                <input type="hidden" value="{{$user->companyId}}" name='companyId' required>

                                @endif
                                <div class="buttcontainer">
                                    <br>
                                    <button class="btn btn-primary " type='submit' id='butform'>Enviar Archivo</button>
                                </div>

                            </form>
                            @include('errors')
                            <div class="message">
                            @if(session("errors"))
                                @foreach($errors as $error)
                                <li class='' id=''>{{$error}}</li>
                                @endforeach
                                @endif
                                @if(session("success"))
                                <h4 class='alert-success' id='message'>{{session('success')}}</h4>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>



@endsection
