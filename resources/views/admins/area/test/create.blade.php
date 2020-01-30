@extends('layouts.app')

@section('content')


<main class="py-4 py-5-mod">
    <div class="container contain">
        <div class="row justify-content-center">
            <section class="addArea">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <p>Crear Nueva Prueba</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/createTest/admins">
                                @csrf
                                <table class='eval'>
                                    <tr>
                                        <p class='bold' id="address addy" >Detalles de la Prueba</p>
                                    </tr>
                                    <tr class="border">
                                        <th id="address">Nombre de la Prueba</th>
                                        <td> <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                required autocomplete="name">

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr class="border">
                                        <div class="input-group mb-3">
                                            <th id="area">Área</th>
                                            <td>
                                                <select  type='text' required id="area"
                                                    class="custom-select @error('area') is-invalid @enderror"
                                                    name="area">
                                                    <option disabled selected>Selecciona área</option>
                                                    @foreach($areas as $area)
                                                    <option value="{{ $area->areaId }}">{{ $area->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('area')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </td>
                                        </div>
                                    </tr>

                                    <tr class="border">
                                        <th id="name">Usuario</th>
                                        <td>
                                            <select  type='text' required id="user"
                                                class="custom-select @error('user') is-invalid @enderror" name="user">
                                                <option disabled selected>Selecciona el usuario
                                                </option>
                                                @foreach($users as $user)
                                                    @foreach($role_user as $role)
                                                        @if($user->id == $role->user_id)
                                                            @if($role->role_id == 4)
                                                                @if($user->companyId == $userCompany)
                                                                    <option value="{{ $user->id }}">{{ $user->firstName }} {{ $user->lastName }}</option>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </select>
                                            @error('user')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr class="border">
                                        <th id="address">Concepto</th>
                                        <td> <input id="concept" type="text"
                                                class="form-control @error('concept') is-invalid @enderror"
                                                name="concept" required autocomplete="concept">

                                            @error('concept')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    @foreach($maturity_levels as $maturity)
                                    <tr class='heady'>
                                        <th class='bold' id="address addy" colspan="2">Atributos del Nivel de Madurez
                                            {{$maturity->description}}</th>
                                    </tr>
                                    @if($maturity->level == 1)
                                    @foreach(range(0,2) as $x)
                                    <tr class="border">
                                        <th>Atributo</th>
                                        <td> <input type="text"
                                                class="form-control @error('attribute') is-invalid @enderror"
                                                name="muy_bajo[{{$x}}]" required autocomplete="muy_bajo[{{$x}}]">

                                            @error('attribute')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    @if($maturity->level == 2)
                                    @foreach(range(0,2) as $x)
                                    <tr class="border">
                                        <th>Atributo</th>
                                        <td> <input type="text"
                                                class="form-control @error('attribute') is-invalid @enderror"
                                                name="bajo[{{$x}}]" required autocomplete="bajo[{{$x}}]">

                                            @error('attribute')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    @if($maturity->level == 3)
                                    @foreach(range(0,2) as $x)
                                    <tr class="border">
                                        <th>Atributo</th>
                                        <td> <input type="text"
                                                class="form-control @error('attribute') is-invalid @enderror"
                                                name="intermedio[{{$x}}]" required autocomplete="intermedio[{{$x}}]">

                                            @error('attribute')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    @if($maturity->level == 4)
                                    @foreach(range(0,2) as $x)
                                    <tr class="border">
                                        <th>Atributo</th>
                                        <td> <input type="text"
                                                class="form-control @error('attribute') is-invalid @enderror"
                                                name="alto[{{$x}}]" required autocomplete="alto[{{$x}}]">

                                            @error('attribute')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    @if($maturity->level == 5)
                                    @foreach(range(0,2) as $x)
                                    <tr class="border">
                                        <th>Atributo</th>
                                        <td> <input type="text"
                                                class="form-control @error('attribute') is-invalid @enderror"
                                                name="muy_alto[{{$x}}]" required autocomplete="muy_alto[{{$x}}]">

                                            @error('attribute')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    @endforeach

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
