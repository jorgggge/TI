@extends('layouts.app')

@section('content')
<div>
    <div class="" >
        <div class="">
            <div class="adminButt">
                <div class="btn-toolbar btn-group-lg" role="toolbar" aria-label="...">
                    <div class="btn-group mr-2" role="group" aria-label="...">
                        <a href="{{url('/admins/area/addArea')}}" class="ButtonAdd_SA  btn border-light">
                            <div><i class="material-icons">add</i></div>
                            <div>Agregar Área </div>
                        </a>
                    </div>
                    <div class="btn-group mr-2" role="group" aria-label="...">
                    <a href="{{url('/addUser/create')}}" class="ButtonAdd_SA  btn border-light">
                            <div><i class="material-icons">add</i></div>
                            <div>Agregar Usuario </div>
                        </a>
                    </div>
                    <div class="btn-group mr-2" role="group" aria-label="...">
                            <a href="{{url('/admins/area/test/create')}}" class="ButtonAdd_SA  btn border-light">
                            <div><i class="material-icons">add</i></div>
                            <div>Crear Prueba </div>
                        </a>
                    </div>
                    <div class="btn-group mr-2" role="group" aria-label="...">
                    <a href="{{url('/admins/area/concept_test/create')}}" class="ButtonAdd_SA  btn border-light">
                            <div><i class="material-icons">add</i></div>
                            <div>Agregar Conceptos a Pruebas </div>
                        </a>
                    </div>

                    @if(empty($areas))
                        <div class="btn-group mr-2" role="group" aria-label="...">
                            <a href="" class="ButtonAdd_SA  btn border-light">
                                <div><i class="material-icons">insert_chart_outlined</i></div>
                                <div>Ver resultados</div>
                            </a>
                        </div>
                    @else
                        <div class="btn-group mr-2" role="group" aria-label="...">
                            <a href="{{route('adminViewResults',$areas[0]->areaId)}}" class="ButtonAdd_SA  btn border-light">
                                <div><i class="material-icons">insert_chart_outlined</i></div>
                                <div>Ver resultados</div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="justify-content-center">
            @if(empty($areas))
                <div class="alert alert-danger" >
                    {{ 'Agrega un área para empezar a trabajar.' }}
                </div>
            @endif
            <div class="">
                <table class="table table-bordered table-light table-hover table-striped tableJ">
                    <thead class="text-white" style="background: #1b4b72;">
                    <tr>
                        <th class="text-center" scope="col">Área</th>
                        <th class="text-center" scope="col">Resultados</th>
                        <th class="text-center" scope="col">Registro</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($areas as $area)
                            <tr>
                                <td class="td text-center" style="font-size: large">{{$area->name }}</td>
                                <td class="td text-center">
                                    <a href="{{route('adminViewResults',$area->areaId)}}" class="Button_See btn"> Ver </a>
                                </td>
                                <td class="td text-center">
                                    <a href="{{route('showAreaAD',$area->areaId)}}" class="Button_See btn"> Editar </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

