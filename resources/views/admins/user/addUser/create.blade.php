@extends('layouts.app')
@section('content')
<main class="py-4 py-5-mod">
    <div class="container contain">
        <div class="row justify-content-center">
            <section class="addArea">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <p>Agregar Usuario a la Empresa</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/admins/user/index">
                                @csrf
                                <table class="Table_Customer" id="tAdmin">
                                    <!--TABLA ADMIN-->
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
                                        <th id="address">Confirmar Contraseña
                                        <td> <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                            @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th id="email">Correo Electrónico</th>
                                        <td> <input id="email" type="email"
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
                                        <th id="firstName">Nombre</th>
                                        <td> <input id="firstName" type="text"
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
                                        <th id="lastName">Apellido</th>
                                        <td> <input id="lastName" type="text"
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
                                        <th for="inputGroupSelect01">Rol Asignado</th>
                                        <td> <select type='text' required id="role"
                                                class="custom-select @error('role') is-invalid @enderror" name="role">
                                                <option disabled selected>Selecciona el rol
                                                </option>
                                                @foreach($roles as $role)
                                                @if($role->id == 3 || $role->id == 4)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <div id='space'>
                                            <th id='head'>Area Asignada</th>
                                        </div>
                                        <td>
                                            <div type='text' class="selectBox custom-select" onclick="showCheckboxes()">
                                                <div type='text' class='custom-select'>
                                                    <option>Seleciona Areas</option>
                                                </div>
                                                <div type='text' class="overSelect"></div>
                                            </div>
                                            <div id="checkboxes">
                                                @foreach ($areas as $area)
                                                @if ($area['companyId'] = $userCompany)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="areas[{{$area['name']}}]" value="{{ $area['areaId'] }}">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        {{ $area['name'] }}
                                                    </label>
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                            @error('area')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                </table>
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
@endsection