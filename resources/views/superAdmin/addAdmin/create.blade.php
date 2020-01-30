@extends('layouts.app')

@section('content')



<main class="py-4 py-5-mod">

    <div class="container contain">

        <div class="justify-content-center">
            <section class="addArea">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <p>Agregar Administrador</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/CreateAdmin/superAdmin">
                                @csrf
                                <table>
                                    <tr>
                                        <th id="name">Nombre de Usuario</th>
                                        <td> <input id="name" type="text"
                                                class="form-control @error('username') is-invalid @enderror"
                                                name="username" value="{{ old('username') }}" required
                                                autocomplete="username" autofocus>

                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th id="address">Contraseña</th>
                                        <td> <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th id="address">Confirmar Contraseña</th>
                                        <td> <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">

                                            @error('password-confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th id="email">Correo Electrónico</span></th>
                                        <td>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th id="email">Nombre</span></th>
                                        <td>
                                            <input id="name" type="text"
                                                class="form-control @error('firstName') is-invalid @enderror"
                                                name="firstName" value="{{ old('firstName') }}" required
                                                autocomplete="firstName" autofocus>

                                            @error('firstName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th id="apellido">Apellido</span></th>
                                        <td>
                                            <input id="name" type="text"
                                                class="form-control @error('lastName') is-invalid @enderror"
                                                name="lastName" value="{{ old('lastName') }}" required
                                                autocomplete="lastName" autofocus>

                                            @error('lastName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <th for="inputGroupSelect01">Empresa Asignada</span></th>
                                        <td>
                                            <select type='text'required id="name"
                                                class="custom-select @error('name') is-invalid @enderror"
                                                name="companyId">
                                                <option disabled selected>Selecciona la empresa...</option>
                                                @php($count=0)

                                                @foreach($companies as $company)
                                                @if ($company->companyId !=1)
                                                <option value="{{ $company->companyId }}">{{ $company->name }}</option>
                                                @endif
                                                @php($count++)
                                                @endforeach

                                                @if($count ==1)
                                                <option disabled selected>No hay empresas</option>
                                                @endif
                                            </select>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                </table>

                                <div class="form-group row mb-0 buttMarg">
                                    <div class="col-md-8">
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
