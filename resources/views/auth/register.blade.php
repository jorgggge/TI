@extends('layouts.app')

@section('content')

<main class="py-4">
    <div class="container contain">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="username"
                                    class="col-md-4 col-form-label text-md-right">{{ __('username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="firstName"
                                    class="col-md-4 col-form-label text-md-right">{{ __('firstName') }}</label>

                                <div class="col-md-6">
                                    <input id="firstName" type="text"
                                        class="form-control @error('firstName') is-invalid @enderror" name="firstName"
                                        value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>

                                    @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="lastName"
                                    class="col-md-4 col-form-label text-md-right">{{ __('lastName') }}</label>

                                <div class="col-md-6">
                                    <input id="lastName" type="text"
                                        class="form-control @error('lastName') is-invalid @enderror" name="lastName"
                                        value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>

                                    @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="roleId"
                                    class="col-md-4 col-form-label text-md-right">{{ __('roleId') }}</label>

                                <div class="col-md-6">
                                    <select name="roles" class="form-control custom-select">
                                        <!-- comment out when refreshing migrations, must have seeders so only super, admin, and analista can access register -->
                                        @if(Auth::user()->hasRole('superadmin'))
                                        <option value="1">SuperAdmin</option>
                                        <option value="2">Admin</option>
                                        @elseif (Auth::user()->hasRole('admin'))
                                        <option value="2">Admin</option>
                                        <option value="3">Analista</option>
                                        <option value="4">Comun</option>
                                        @elseif (Auth::user()->hasRole('analista'))
                                        <option value="4">Comun</option>
                                        @endif
                                        <!-- <option value="1">SuperAdmin</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Analista</option>
                                        <option value="4">Comun</option> -->


                                    </select>
                                    @error('roleId')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="companyId"
                                    class="col-md-4 col-form-label text-md-right">{{ __('companyId') }}</label>

                                <!-- <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="companyId"
                                        value="{{ old('companyId') }}" autofocus> -->
                                <div class="col-md-6">
                                    <select name="companyId" class="form-control custom-select">
                                        <!-- comment out when refreshing migrations, must have seeders so only super, admin, and analista can access register -->
                                        @foreach($company as $empressa)
                                        <option value="{{$empressa->companyId}}">{{$empressa->name}}</option>
                                        @endforeach


                                    </select>

                                    @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>




                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>

                            @include('errors')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection