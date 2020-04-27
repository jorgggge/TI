@extends('layouts.login')

@section('content') 
<form id="sign_in" method="POST" action="{{ route('login') }}">
    @csrf  
                    <div class="msg">Inicia sesión para comenzar tu sesión</div>
                    @error('username')
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <strong>Oh no!</strong> Usuario o contraseña incorrectos
                            </div>
                    @enderror 
                    @error('password')
                                 <div class="alert alert-danger alert-dismissible" role="alert">
                                    <strong>Oh no!</strong> Usuario o contraseña incorrectos
                                </div>
                    @enderror
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Usuario" required autofocus>
                            
                        </div>
                       
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Recuerdame </label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn  bg-pink waves-effect" type="submit">Entrar</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="sign-up.html"></a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
                        </div>
                    </div>
                </form>


@endsection

