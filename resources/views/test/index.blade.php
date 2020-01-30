@extends('layouts.app')

@section('content')

<main class="py-4 py-5-mod">

    <div class="container contain">

        <div class="row justify-content-center">
            <section class="addArea">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <p>Selecciona tu evidencia </p>
                        </div>
                        <div class="card-body">
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
                                    <button class="butt " type='submit' id='butform'>Enviar Archivo</button>
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
            </section>
        </div>
    </div>

</main>

@endsection
