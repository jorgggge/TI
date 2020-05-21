@extends('layouts.app')
@section('content')

<div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 24px;">assignment</i>
                            Pruebas
                        </div>
                        <div class="body ">
                            <b> Aqui se muestras todas las pruebas para las areas de la compañia.</b>
                            <br><br>
                             <div class="table-responsive" >
                                    <table id="dtBasicExample" class="table table-hover" style="width: 100%;">
                                        <thead> 
                                                <tr>
                                                    <th>Prueba</th>
                                                    <th>Area</th>
                                                    <th>Editar</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Concepts as $C)
                                             <tr>
                                                <td>{{ $C->test }}</td>
                                                <td>{{ $C->area }}</td>
                                                <td>
                                                    <button class="btn btn-primary" onclick="window.location='/Admin/up/{{$C->testId }}/{{ $C->areaId}}'">
                                                         <i class="material-icons">edit</i> 
                                                    </button> 
                                                    <button class="btn btn-danger" onclick="window.location='Test_Delete({{ $C->testId }});">
                                                        <i class="material-icons">clear</i> 
                                                    </button> 
                                                </td>
                                                </tr>
                                            @endforeach
                                        </tbody>   
                                    </table>
                            </div>
                            
                        </div>
                    </div>
            </div>
            <div class="col-lg-6">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 24px;">assignment_turned_in</i>
                            Conceptos
                        </div>
                        <div class="body">
                            <b> Aqui se muestras todas los conceptos de las pruebas de las areas de la compañia.</b>
                             <br><br>
                             <div  class="table-responsive" >
                                    <table id="dtBasicExamplee" class="table table-hover" style="width: 100%;">
                                        <thead> 
                                                <tr>
                                                    <th>Concepto</th>
                                                    <th>Prueba</th>
                                                    <th>Editar</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach ($Pruebas as $Prueba)
                                             <tr>
                                                <td>{{ $Prueba->concept }}</td>
                                                <td>{{ $Prueba->test }}</td>
                                                <td>
                                                    <button class="btn btn-primary" onclick="window.location='/admin/prueba/{{$Prueba->testId }}/{{ $Prueba->conceptId}}'">
                                                        <i class="material-icons">edit</i>
                                                    </button> 
                                        
                                                    <button class="btn btn-danger" onclick="window.location='Test_Delete({{ $Prueba->testId }});">
                                                        <i class="material-icons">clear</i> 
                                                    </button> 
                                                </td>
                                                </tr>
                                            @endforeach
                                        </tbody>   
                                    </table>
                            </div>
                         
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
                $('#dtBasicExamplee').DataTable({
                    language: {
                        url: '{{ asset('json/Spanish.json')}}'
                    },
                    "paging":   true,
                    "ordering": false,
                    "searching": true,
                    "info":     false,
                    "responsive": true
                });
          
    </script>
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