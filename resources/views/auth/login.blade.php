@extends('layouts.login')

@section('content')                            
<form autocomplete="off" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="username" class="align text-md-right label">{{ __('Usuario') }}</label>
                                        <div class="cols" >
                                            <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="off" autofocus>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="align text-md-right label">{{ __('Contraseña') }}</label>
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
                                    <div class="col" style="width: 100%;text-align: right;">
                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link restore login-forget" href="{{ route('password.request') }}">{{ __('Olvidé mi contraseña.') }}</a>
                                        <button type="submit" class="btn btn-primary btn-login">
                                            {{ __('Iniciar ') }}
                                        </button>
                                    @endif
                                    </div>
                                </div>
                            </form>

@endsection
