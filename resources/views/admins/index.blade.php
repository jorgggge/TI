@extends('layouts.app')

@section('content')

<div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">
                                <a href="#" style="color: white;">Areas</a>
                            </h2>
                        </div>
                        <div class="body">
                              <div class="row clearfix">
                                <div class="col-sm-8">
                                    <h5>Se mostrar las areas registradas de la empresa:</h5>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                         <span class="input-group-addon">
                                            <i class="material-icons">search</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" id="myInput" class="form-control" placeholder="Buscar Area" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(empty($areas))
                                <div class="alert alert-danger" >
                                    {{ 'Agrega un área para empezar a trabajar.' }}
                                </div>
                            @else
                             <div class="table-responsive">
                                    <table id="dtBasicExample" class="table table-hover">
                                        <thead> 
                                                <tr>
                                                    <th>Área</th>
                                                    <th>Resultados</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($areas as $area)
                                            <tr>
                                                <td>{{$area->name }}</td>
                                                 <td>      
                                                  <button type="button" class="btn btn-success waves-effect" onclick="window.location='{{route('adminViewResults',$area->areaId)}}'" >
                                                    Ver
                                                    </button>
                                                </td>
                                                <td> 
                                                    <button type="button" class="btn btn-primary waves-effect" onclick="EditarArea({{ $area->areaId }},'{{$area->name }}')">
                                                        Editar
                                                        </button>
                                                </td>
                                                 <td> 
                                                        <button type="button" class="btn btn-danger waves-effect" onclick="Area_Delete({{ $area->areaId }});">
                                                            Eliminar
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

<script type="text/javascript">

$("#Area").addClass('active');
$("#MostrarAreas").addClass('active');


    function  EditarArea(Id,Name) {
        swal("Cambia nombre de "+Name+" a:", {
            content: "input",
          })
          .then((value) => {
                $.ajax({
                      type: "GET",
                      url: "/admins/area/Edit/editArea/EditArea/"+Id+"/"+value,
                      success: function(response){
                      }
                });
            });
      }


function Area_Delete(Id) {
            swal({
              title: "Atecion",
              text: "Se cambiara el status de este compañia, Estas seguro?!",
              icon: "warning",
              buttons: true,
              dangerMode: true
            })
            .then((willDelete) => {
              if (willDelete) {
                window.location = "/admins/area/Edit/editArea/delete/"+Id;
              
              } else {
              }
            });
                
            }
</script>
@endsection

