@extends('layouts.app')

@section('content')

<main class="py-4 py-5-mod">

    <div class="container contain">

        <div class="row justify-content-center">
            <section class="addArea">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <p>Cambiar tu evidencia </p>


                        </div>
                        <div class="card-body">
                            <form method='POST' action="{{route('upload.update', $data->evidenceId)}}"
                                enctype='multipart/form-data'>
                                <!-- Browsers don't yet understand PATCH and DELETE request types for your forms.
    To get around this limitation: method_field("PATCH") & csrf_field() -->
                                @method('PATCH')
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


                                <section class="field">


                                    <section class="control">

                                        <input type="hidden" class="input" name='attributeId'
                                            value='{{$data->attributeId}}'>

                                    </section>

                                </section>

                                <section class="field">


                                    <section class="control">

                                        <input type="hidden" class="input" name='verified' value='{{$data->verified}}'>

                                    </section>

                                </section>

                                <section class="field">


                                    <section class="control">

                                        <input type="hidden" class="input" name='userId' value='{{$data->userId}}'>

                                    </section>

                                </section>
                                <section class="field">


                                    <section class="control">

                                        <input type="hidden" class="input" name='companyId'
                                            value='{{$data->companyId}}'>

                                    </section>

                                </section>
                                <!-- <section class="field">

        <label for="evidenceId" class="label">evidenceId</label>

        <section class="control">

            <input type="integer" class="input" name='evidenceId' value='{{$data->evidenceId}}'>

        </section>

    </section> -->
                                <div class="buttcontainer">
                                    <button class="butt " name='edit' type='submit' id='butform'>Enviar Nuevo Archivo</button>
                                </div>

                            </form>
                            @include('errors')
                            <div class="message">
                                @if(session("errors"))
                                @foreach($errors as $error)
                                <li class='message' id='message'>{{$error}}</li>
                                @endforeach
                                @else(session("success"))
                                <h4 class='message' id='message'>{{session('success')}}</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

</main>

@endsection
