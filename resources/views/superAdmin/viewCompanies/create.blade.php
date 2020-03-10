@extends('layouts.app')

@section('content')
@php($count=1)

<div id="Panel">
    <div id="Cabezara" class="Item">
        <div style="width: 100%;background-color: white;">
            <table style="width: 90%;margin: auto;">
                        <tr>
                            <td>
                                <center>
                                    <img src="{{ asset('imagenes/empresa.png') }}" height="100px">
                                <h4>Compañias</h4>
                                </center>
                            </td>
                            <td>
                                
                                <p class="text-dark">Se mostrar cada empresa registrada:</p>
                                <div style="display: grid;grid-template-columns: 1fr 1fr;grid-gap: 10px;">
                                    <div>
                                        <input class="form-control" id="anythingSearch" type="text" placeholder="Busquedad por Compañia o Administrador" style="width: 100%;">
                                    </div>
                                    <div>
                                        <a href="{{url('CreateAdmin/addAdmin/create')}}" class="btn btn-success"> Añadir Administrador </a>
                                    </div>
                                    
                                </div>
                            </td>

                        </tr>
                    </table>
                    <br>

                <div id="area_admins">
                        <div id="area" style="width: 100%;text-align: center;">    
                    <table class="table table-hover">
                       <thead style="background-color: #112d4e;color: white;width: 100%;">
                            <tr style="height: 50px;">
                                <td >Estado</td>
                                <td >Empresa</td>
                                <td >Direccion</td>
                                <td >Telefono</td>
                                <td >Correo</td>
                                <td >Registro</td>
                            </tr>
                        </thead>
                        <tbody id="Mytable">
                        @foreach($Com as $C)
                            @if($C->companyId != 1)
                            <tr style="margin: auto;padding:20px;">
                                <td>
                                    <form class='viewCompany form'  method="POST" action="{{ route('status',$C->companyId) }}">
                                        @method('PUT')
                                        @csrf
                                        @if ($C->status == 0)
                                            <img id="A{{ $C->status }}" class="Si" src="{{ asset('imagenes/Si.png') }}" onclick="Admin_Activa({{ $C->name }},'{{ csrf_token() }}')" height="50px">
                                        @endif
                                        @if ($C->status != 0)
                                            <img id="A{{ $C->status }}" class="No" src="{{ asset('imagenes/No.png') }}" onclick="Admin_Activa({{ $C->name }},'{{ csrf_token() }}')" height="50px">
                                        @endif
                                    </form>
                                    </td>
                                        <td class="td">{{$C -> name}}</td>
                                        <td class="td">{{$C -> address}}</td>
                                        <td class="td">{{$C -> phoneNumber}}</td>
                                        <td class="td">{{$C -> email}}</td>
                                        <td class="td"><a href="{{ route('ShowCompanySA',$C->companyId) }}" class="btn btn-primary"> Ver </a></td>
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


@endsection
