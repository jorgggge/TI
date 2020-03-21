@extends('layouts.app')

@section('content')
@php($count=1)

        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    <!-- Administradores -->
                    <small></small>
                </h2>
            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header  bg-blue-grey">
                            <h2>
                                Compañias
                            </h2>
                            <ul class="header-dropdown m-r-0">
                                <li>
                                    <a href="javascript:void(0);">
                                        <i class="material-icons">info_outline</i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <i class="material-icons">help_outline</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="body">
                         <div class="row clearfix">
                                <div class="col-sm-4">
                                    
                                        <button type="button" class="btn btn-lg btn-primary waves-effect">
                                            <i class="material-icons">person_add</i>
                                            <span>Agregar Compañia</span>
                                        </button>

                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                         <span class="input-group-addon">
                                            <i class="material-icons">search</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" id="myInput" class="form-control" placeholder="Buscar Compañia" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-hover">
                                   <thead >
                                        <tr>
                                            <th >Estado</th>
                                            <th >Empresa</th>
                                            <th >Direccion</th>
                                            <th >Telefono</th>
                                            <th >Correo</th>
                                            <th >Registro</th>
                                        </tr>
                                    </thead>
                                    <tbody id="Mytable" >
                                    @foreach($Com as $C)
                                        @if($C->companyId != 1)
                                        <tr>
                                            <td>
                                                <form class='viewCompany form'  method="POST" action="{{ route('status',$C->companyId) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    @if ($C->status != 0)
                                                        <button type="button" class="btn btn-success btn-circle-lg waves-effect waves-circle waves-float">
                                                            <i class="material-icons">work</i>
                                                        </button>

                                                    @endif
                                                    @if ($C->status == 0)
                                                         <button type="button" class="btn btn-warning btn-circle-lg waves-effect waves-circle waves-float">
                                                        <i class="material-icons">work_off</i>
                                                        </button>
                                                    @endif
                                                </form>
                                                </td>
                                                    <td>{{$C -> name}}</td>
                                                    <td>{{$C -> address}}</td>
                                                    <td>{{$C -> phoneNumber}}</td>
                                                    <td>{{$C -> email}}</td>
                                                    <td><a href="{{ route('ShowCompanySA',$C->companyId) }}" class="btn btn-primary btn-circle-lg waves-effect waves-circle waves-float"><i class="material-icons" style="margin: auto;">create</i></a></td>
                                        </tr>
                                        @endif
                                        @php($count++)
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
<script src="{{ asset('js/code.js') }}"></script>


@endsection
