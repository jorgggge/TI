@extends('layouts.app')
@section('content')

<div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 24px;">assignment_turned_in</i>
                            Pruebas
                        </div>
                        <div class="body ">
                            @if(empty($areas))
                                <div class="alert alert-danger" >
                                    {{ 'No se asignado ninguna area.' }}
                                </div>
                            @else
                             <div class="row clearfix">
                                <div class="col-sm-8">
                                    Aqui se muestras todas las pruebas para las areas de la compañia.
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                             <div class="table-responsive" >
                                    <table id="dtBasicExample" class="table table-hover">
                                        <thead> 
                                                <tr>
                                                    <th>Prueba</th>
                                                    <th>Usuario</th>
                                                    <th></th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach ($Pruebas as $Prueba)
                                             <tr>
                                                <td>{{ $Prueba->name }}</td>
                                                <td>{{ $Prueba->firstName." ".$Prueba->lastName }}</td>
                                                <td>
                                                    <button class="btn btn-primary" onclick="window.location='/analista/pruebas/{{$Prueba->testId."/".$Prueba->id }}'">
                                                        <i class="material-icons">edit</i> <span>Editar</span>
                                                    </button>
                                                </td>
                                             </tr>
                                            @endforeach
                                        </tbody>   
                                    </table>
                            </div>
                            @endif
                        </div>
                    </div>
            </div>
</div>

@endsection