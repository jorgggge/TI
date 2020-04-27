@extends('layouts.app')
@section('content')

<div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">
                                <a href="#" style="color: white;">Pruebas</a>
                            </h2>
                        </div>
                        <div class="body">
                            @if(!empty($areas))
                                <div class="alert alert-danger" >
                                    {{ 'Agrega un área para empezar a trabajar.' }}
                                </div>
                            @else
                             <div class="row clearfix">
                                <div class="col-sm-8">
                                    <h5>Aqui se muestras todas las pruebas para las areas de la compañia</h5>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                         <span class="input-group-addon">
                                            <i class="material-icons">search</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" id="myInput" class="form-control" placeholder="Buscar prueba" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="table-responsive">
                                    <table id="dtBasicExample" class="table table-hover">
                                        <thead> 
                                                <tr>
                                                    <th>Área</th>
                                                    <th>Prueba</th>
                                                    <th>Concepto</th>
                                                    <th>Usuaio</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach ($Pruebas as $Prueba)
                                            <tr>
                                                <td>{{ $Prueba->area }}</td>
                                              	<td>{{ $Prueba->test }}</td>
                                                <td>{{ $Prueba->concept }}</td>
                                                <td>{{ $Prueba->user }}</td>
                                                <td>
                                                	<input type="button" class="btn btn-primary" name="" value="Editar" onclick="window.location='/admin/prueba/{{$Prueba->testId }}/{{ $Prueba->conceptId}}/{{ $Prueba->userId }}'">
                                                </td>
                                                <td><input type="button" class="btn btn-danger" name="" value="Eliminar" onclick="window.location='Test_Delete({{ $Prueba->testId }});"></td>
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