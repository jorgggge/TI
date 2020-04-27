@extends('layouts.app')

@section('content')

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
                        <div class="header" style="background-color: #112d4e;">
                            
                            <h2 style="color: white;">
                                Usuarios
                            </h2>
                        </div>
                        
                        <div class="body">
                         <div class="row clearfix">
                                <div class="col-sm-8">
                                    <h4 class="card-iniside-title">
                                        Aqui se mostrar los ususrios analistas y comunes.
                                    </h4>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                         <span class="input-group-addon">
                                            <i class="material-icons">search</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" id="myInput" class="form-control" placeholder="Buscar Usuario" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-hover">
                                <thead>
                                  <tr>
									<th>Status</th>
								    <th>Nombre</th>
								    <th>Usuario</th>
								    <th>Rol</th>
								    <th>Email</th>
								    <th>Actulizacion</th>
								</tr>
                                </thead>
                                <tbody id="myTable">
                               @foreach ($Users as $user)
							    		<tr> 
                                            <td>
                                                @if ($user->status != 0 )
                                               <button type="button" class="btn btn-success  waves-effect" onclick="User_Delete({{ $user->id }},0)">
                                                    Habilitado
                                                </button>
                                                @else
                                                <button type="button" class="btn btn-warning waves-effect" onclick="User_Delete({{ $user->id }},1)">
                                                    Deshabilitado
                                                </button>
                                                @endif
                                            </td>
								    		<td>{{ $user->firstName." ".$user->lastName }}</td>
								    		<td>{{ $user->username }}</td>
								    		@if ($user->role_id == 3)
								    			<td>Analista</td>
								    		@endif
								    		@if ($user->role_id == 4)
								    			<td>Comun</td>
								    		@endif
								    		<td>{{ $user->email }}</td>
								    		<td>
								    			<input type="button" class="btn btn-primary" name="" value="Editar" style="background-color: green;color: white;border:none;"
												onclick="window.location='{{ route('UpdateUsers',$user->id) }}'">
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
            <!-- #END# Basic Examples -->
        </div>
<script src="{{ asset('js/code.js') }}"></script>
<script type="text/javascript">
    $("#Usuarios").addClass('active');
    $("#MostrarUsuarios").addClass('active');

function User_Delete(Id,A) {
            swal({
              title: "Atecion",
              text: "Se cambiara el status de este ususrio, Estas seguro?!",
              icon: "warning",
              buttons: true,
              dangerMode: true
            })
            .then((willDelete) => {
              if (willDelete) {
                window.location = "/Admin/Userdelete/delete/"+Id+"/"+A;
              
              } else {
              }
            });
                
            }
</script>
@endsection
