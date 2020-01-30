@extends('layouts.app')
@section('content')
        <div class="container mb-4">
            <div class="row">
                <div class="col text-center">
                    <a href="{{url('CreateCompany/addCompany/create')}}" class="btn border-light">
                        <div><i class="material-icons">location_city</i></div>
                        <div>Añadir Empresa</div>
                    </a>
                </div>
                <div class="col text-center">
                    <a href="{{url('CreateAdmin/addAdmin/create')}}" class="btn border-light">
                        <div><i class="material-icons">person_add</i></div>
                        <div>Añadir Administrador</div>
                    </a>
                </div>
                <div class="col text-center">
                    <a href="{{url('/superAdmin/viewCompanies/create')}}" class="btn border-light">
                        <div><i class="material-icons">remove_red_eye</i></div>
                        <div>Empresas Creadas</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="container mb-4">
            <div class="col text-center">
                <input class="form-control" id="myInput" type="text" placeholder="Buscar..." style="display: unset !important; width: 60%">
            </div>
        </div>

        <div class="container">
            <div data-simplebar class="table-responsive">
            <div class="col text-center">
            <table class="table CompanyList table-bordered tt">
                <thead class="ShowCompanyH">
                <tr>
                    <th class="compTD">ESTADO</th>
                    <th class="compTD">EMPRESA</th>
                    <th class="compTD">ADMINISTRADOR</th>
                    <th class="compTD">USUARIO</th>
                    <th class="compTD">TELÉFONO</th>
                    <th class="compTD">CORREO</th>
                    <th class="compTD">REGISTRO</th>
                </tr>
                </thead>
                <tbody class="ShowCompanyB" id ="ShowCompanyB">
                @foreach($Admins as $users)
                    <tr>
                        <td >
                            <form class='viewCompany form' method="POST" action="{{ route('DeleteCustomer',$users->companyId) }}">
                                @method('PUT')
                                @csrf
                                @if ($users->status == 0)
                                    <input type="hidden" name="status" style="width: 0px;border:none; " readonly value="1">
                                    <input type="submit" value="Deshabilitado" class="btn"
                                           style="background-color: red;color:white;">@endif
                                @if ($users->status != 0)
                                    <input type="hidden" name="status" style="width: 0px;border:none; " readonly value="0">
                                    <input type="submit" value="Habilitado" class="btn"
                                           style="background-color: #5cb85c;color:white;">
                                @endif
                            </form>
                        </td>
                        <td class="td">{{$users->name }}</td>
                        <td class="td">{{ $users->firstName." ".$users->lastName }}</td>
                        <td class="td">{{$users -> username}}</td>
                        <td class="td">{{$users->phoneNumber }}</td>
                        <td class="td">{{$users->email}}</td>
                        <td class="td">
                            <a href="{{ route('ViewCustomer',$users->id) }}" class="Button_See btn"> Ver </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
            </div>
        </div>
@endsection
