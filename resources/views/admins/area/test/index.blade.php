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
                            @if(!empty($areas))
                                <div class="alert alert-danger" >
                                    {{ 'Agrega un área para empezar a trabajar.' }}
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
                                                    <th>Área</th>
                                                    <th>Prueba</th>
                                                    <th>Concepto</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $test = ""; 
                                                $C = "";   
                                            @endphp
                                        	@foreach ($Pruebas as $Prueba)
                                            @if ($test != $Prueba->test)
                                             <tr>
                                                <td>{{ $Prueba->area }}</td>
                                                <td>{{ $Prueba->test }}</td>
                                                <td></td>
                                                <td>
                                                    <button class="btn btn-primary" onclick="window.location='/Admin/up/{{$Prueba->testId }}/{{ $Prueba->areaId}}'">
                                                         <i class="material-icons">edit</i> <span>Editar</span> 
                                                    </button> 
                                                </td>
                                                <td></td>
                                                @php
                                                    $test = $Prueba->test;
                                                @endphp

                                            @endif
                                                @if ($C != $Prueba->concept)
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td>{{ $Prueba->concept }}</td>
                                                        <td>
                                                            <button class="btn btn-primary" onclick="window.location='/admin/prueba/{{$Prueba->testId }}/{{ $Prueba->conceptId}}'">
                                                                <i class="material-icons">edit</i> <span>Editar</span> 
                                                            </button> 
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger" onclick="window.location='Test_Delete({{ $Prueba->testId }});">
                                                                <i class="material-icons">clear</i> <span>Eliminar</span> 
                                                            </button> 
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $C = $Prueba->concept
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </tbody>   
                                    </table>
                            </div>
                            @endif
                        </div>
                    </div>
            </div>
</div>


@if (session()->has('test_update'))
    <script type="text/javascript">
    swal("Listo!", "Actualización exisitosa de la Prueba!", "success");
    </script>
@endif

@if (session()->has('Test'))
    <script type="text/javascript">
    swal("Listo!", "Se ha ingresado una nueva Prueba!", "success");
    </script>
@endif

@if (session()->has('Concept'))
    <script type="text/javascript">
    swal("Listo!", "Se ha ingresado un nuevo Concepto!", "success");
    </script>
@endif


<script type="text/javascript">
    $("#Pruebas").addClass('active');
    $("#MostrarPruebas").addClass('active');


    function Test_Delete(Id) {
            swal({
              title: "Atecion",
              text: "Se cambiara el status de este ususrio, Estas seguro?!",
              icon: "warning",
              buttons: true,
              dangerMode: true
            })
            .then((willDelete) => {
              if (willDelete) {
                window.location = "/admins/area/test/edit/delete"+Id;
              
              } else {
              }
            });
                
            }

</script>
@endsection