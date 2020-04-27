@extends('layouts.app')

@section('content')
<div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">
                                <a href="#" style="color: white;">Usuarios</a> >  Editar usuario
                            </h2>
                            <ul class="header-dropdown m-r--5">
                              
                            </ul>
                        </div>
                        <div class="body">
                            
                            <h5>Llena los campos con los datos del Usuario: <br> (*) Datos Obligatorios </h5> 
                            <h2 class="card-inside-title">Datos del Usuario:</h2>
                             <form id="from" method="POST" action="{{ route('UpdateUsers',[$User['id']]) }}">
                              @method('PUT')
                              @csrf
                            <div class="row clearfix">
                                <div class="col-sm-4">
                                    <p>
                                        <b>Usuario</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">person</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="username" class="form-control" placeholder="Usuario" required value="{{ $User['username'] }}">
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Nombres</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">assignment</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="firstName" required id="lastNameS"  class="form-control" placeholder="Nombres" value="{{ $User['firstName'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Apellidos</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">assignment</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="lastName" id="lastNameS"  class="form-control" placeholder="Apellidos" required value="{{ $User['lastName'] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                 <div class="col-sm-4">
                                     <p>
                                        <b>* Email</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="emailuser" id="lastNameS"  class="form-control" placeholder="email" required value="{{ $User['email']  }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        <b>* Areas</b>
                                    </p>
                                        @php($count=0)
                                        @foreach ($Array_Areas as $UA)

                                        @if ($UA['validar'])
                                        <input class="form-check-input" type="checkbox" name="checked{{ $UA['areaId']}}"
                                            value="{{ $UA['areaId']}}" id="defaultCheck{{ $UA['areaId']}}" checked="true">
                                        @else
                                        <input class="form-check-input" type="checkbox" name="checked{{ $UA['areaId']}}"
                                            value="{{ $UA['areaId']}}" id="defaultCheck{{ $UA['areaId']}}">
                                        @endif
                                        <label class="form-check-label" for="defaultCheck{{ $UA['areaId']}}">
                                            {{ $UA['name']}}
                                        </label>
                                        <br>
                                        @endforeach
                                </div>
                            </div>
                            <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-4">
                                     <button class="btn btn-info" type="submit">Guardar</button>
                                </div>
                            </div>
                                       
                            </form>

                        </div>
                    </div>
            </div>
</div>

<script type="text/javascript">
    $("#Usuarios").addClass('active');
    $("#MostrarUsuarios").addClass('active');

</script>
@endsection