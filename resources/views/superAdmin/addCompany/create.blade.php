@extends('layouts.app')

@section('content')



<main class="py-4 py-5-mod">

    <div class="container contain">

        <div class="justify-content-center">
            <section class="addArea">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <p>Agregar Compañia</p>
                        </div>

                        <div class="card-body">
                            @csrf

                            <form method="POST" action="/CreateCompany/superAdmin">
                                @csrf

                                <table class="Table_Customer" id="tAdmin">
                                    <!--TABLA ADMIN-->
                                    <tr>
                                        <th id="name">Nombre</th>
                                        <td> <input name="name" type="text"
                                                class="form-control  @error('name') is-invalid @enderror"
                                                placeholder="Nombre de la empresa" aria-label="Nombre"
                                                aria-describedby="basic-addon1" required autocomplete="name" autofocus
                                                value={{Request::old('name')}}>
                                        </td>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>

                                        @enderror
                                    </tr>
                                    <tr>
                                        <th id="address">Dirección</th>
                                        <td> <input name="address" type="text"
                                                class="form-control  @error('address') is-invalid @enderror"
                                                placeholder="Dirección de la empresa" aria-label="address"
                                                aria-describedby="basic-addon1" required autocomplete="address" autofocus
                                                value={{Request::old('address')}}>
                                            @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th id="phoneNumber">Teléfono</th>
                                        <td> <input name="phoneNumber" type="tel"
                                                class="form-control  @error('phoneNumber') is-invalid @enderror"
                                                placeholder="Teléfono de la empresa" aria-label="phoneNumber"
                                                aria-describedby="basic-addon1" required autocomplete="phoneNumber"
                                                autofocus value={{Request::old('phoneNumber')}}>

                                            @error('phoneNumber')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th id="email">Correo Electrónico</th>
                                        <td>
                                            <input name="email" type="email"
                                                class="form-control  @error('email') is-invalid @enderror"
                                                placeholder="Correo electrónico de la empresa" aria-label="email"
                                                aria-describedby="basic-addon1" required autocomplete="email" autofocus
                                                value={{Request::old('email')}}>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                </table>
                                <div class="form-group row mb-0">
                                    <div class="addButt">
                                        <button type="submit" class="btn btn-add btn-primary">Agregar</button>
                                    </div>
                                </div>
                            </form>
                            @include('errors')
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

@endsection
