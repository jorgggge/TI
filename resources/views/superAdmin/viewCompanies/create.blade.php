@extends('layouts.app')

@section('content')
@php($count=1)
<div class="container" style="margin-bottom: 1em; margin-top: 1em;">
    <div class="row">
		<div class="btn-group-toggle">
			<a href="{{url('/superAdmin')}}" class="ButtonAdd_SA btn border-light">
				<div><i class="material-icons">home</i></div>
                <div>Inicio</div>
            </a>
            <a href="{{url('CreateAdmin/addAdmin/create')}}" class="ButtonAdd_SA btn border-light">
                <div><i class="material-icons">person_add</i></div>
                <div>Agregar Administrador</div>
            </a>
            <a href="{{url('CreateCompany/addCompany/create')}}" class="ButtonAdd_SA btn border-light">
                <div><i class="material-icons">location_city</i></div>
                <div>Agregar Compañía</div>
            </a>
        </div>
    </div>
</div>
<div class="Search">
    <input class="form-control" id="myInput" type="text" placeholder="Buscar...">
</div>
<div class="ShowCompanies">
    <table class="table CompanyList table-bordered tt">
		<thead class="ShowCompanyH">
			<tr>
				<td class='compTD'>#</td>
				<td class='compTD'>ESTADO</td>
				<td class='compTD'>EMPRESA</td>
			    <td class='compTD'>DIRECCIÓN</td>
				<td class='compTD'>TELÉFONO</td>
				<td class='compTD'>CORREO</td>
				<td class='compTD'>REGISTRO</td>
			</tr>
		</thead>
		<tbody class="ShowCompanyB" id ="ShowCompanyB">
		@foreach($Com as $C)
            @if($C->companyId != 1)
			<tr>
				<td>{{$count}}</td>
				<td>
                    <form class='viewCompany form'  method="POST" action="{{ route('status',$C->companyId) }}">
                        @method('PUT')
                        @csrf
                        @if ($C->status == 0)
                            <input type="hidden" name="status" style="width: 0px;border:none; " readonly value="1">
                            <input type="submit" value="Deshabilitado" class="btn"
                                   style="background-color: red;color:white;">
                             @endif
                        @if ($C->status != 0)
                            <input type="hidden" name="status" style="width: 0px;border:none; " readonly value="0">
                            <input type="submit" value="Habilitado" class="btn"
                                style="background-color: #5cb85c;color:white;">
                        @endif
                    </form>
                    </td>
                        <td class="td">{{$C -> name}}</td>
                        <td class="td">{{$C -> address}}</td>
                        <td class="td">{{$C -> phoneNumber}}</td>
                        <td class="td">{{$C -> email}}</td>
                        <td class="td"><a href="{{ route('ShowCompanySA',$C->companyId) }}" class="Button_See btn"> Ver </a></td>
			</tr>
            @endif
            @php($count++)
		@endforeach
		</tbody>
    </table>
</div>

@endsection
