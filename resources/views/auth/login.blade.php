@extends('layouts.login')

@section('content')
        <div class="wrapper-less">
            <div class="container-less">
                <div class="col">
                    <div class="card login-card">
                        <div class="card-body">
                            <form autocomplete="off" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="username" class="align text-md-right label">{{ __('USUARIO') }}</label>
                                        <div class="cols">
                                            <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="off" autofocus>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="align text-md-right label">{{ __('CONTRASEÑA') }}</label>
                                        <div class="cols">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                </div>

                                <div class="form-group">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary btn-login">
                                            {{ __('Iniciar ') }}
                                        </button>
                                    </div>
                                </div>

                                <div class='form-check space'>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link restore login-forget" href="{{ route('password.request') }}">{{ __('Olvidé mi contraseña.') }}</a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
@endsection
