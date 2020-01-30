@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container contain">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verifique su dirección de correo electrónico') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Se ha enviado un enlace de verificación a su dirección de correo electrónico.') }}
                        </div>
                        @endif

                        {{ __('Para continuar deberas validar tu correo electrónico, haz click a continuación para enviarte un enlace de verificación a tu correo.') }}
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('Click Aquí =)') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
