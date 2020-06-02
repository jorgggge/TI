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
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 20px;">supervisor_account</i>
                            Usuarios
                        </div>
                        
                        <div class="body">
                         <div class="row clearfix">
                                <div class="col-sm-8">
                                        <b>Aquí se mostrar los usuarios analistas y comunes de su compañía.</b>
                                </div>
                                <div class="col-sm-4">
                                   
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-hover">
                                <thead>
                                  <tr>
                  								    <th>Nombre</th>
                  									<th>Estatus</th>
                  								    <th>Usuario</th>
                  								    <th>Rol</th>
                  								    <th>Email</th>
                  								    <th>Editar</th>
                  								</tr>
                                                  </thead>
                                                  <tbody id="myTable">
                                                 @foreach ($Users as $user)
                  							    		<tr> 
                  								    		<td>{{ $user->firstName." ".$user->lastName }}</td>
                                                              <td>
                                                                  @if ($user->status == 0 )
                                                                 <button type="button"  id="btn-{{ $user->id }}"  class="btn btn-success  waves-effect" onclick="User_Delete({{ $user->id }},0)">
                                                                       <i class="material-icons" id="mc-{{ $user->id }}">work</i> <span id="s-{{ $user->id }}">Habilitar</span>
                                                                  </button>
                                                                  @else
                                                                  <button type="button"  id="btn-{{ $user->id }}" class="btn btn-warning waves-effect" onclick="User_Delete({{ $user->id }},1)">
                                                                       <i class="material-icons" id="mc-{{ $user->id }}" id="s-{{ $user->id }}">lock</i> <span id="s-{{ $user->id }}">Bloquear</span> 
                                                                  </button>
                                                                  @endif
                                                              </td>
                  								    		<td>{{ $user->username }}</td>
                  								    		@if ($user->role_id == 3)
                  								    			<td>Analista</td>
                  								    		@endif
                  								    		@if ($user->role_id == 4)
                  								    			<td>Comun</td>
                  								    		@endif
                  								    		<td>{{ $user->email }}</td>
                  								    		<td>

                                                <button class="btn btn-primary waves-effect" onclick="window.location='/admins/user/{{ $user->id }}'">
                                                    <i class="material-icons" >mode_edit</i>
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
            <!-- #END# Basic Examples -->
        </div>
<script src="{{ asset('js/code.js') }}"></script>
<script type="text/javascript">
    $("#Usuarios").addClass('active');
    $("#MostrarUsuarios").addClass('active');

function User_Delete(Id,A) {
            swal({
              title: "Atecion",
              text: "Se cambiara el estatus de este usuario, Estas seguro?!",
              icon: "warning",
              buttons: true,
              dangerMode: true
            })
            .then((willDelete) => {
              if (willDelete) {
                
                A = $("#btn-"+Id).hasClass("btn-success") ? 1 : 0;

                $.ajax({
                      type: "GET",
                      url: "/Admin/Userdelete/delete/"+Id+"/"+A,
                      success: function(response){}
                });

                
                 if(A == 1){
                   $("#btn-"+Id).removeClass("btn-success");
                   $("#btn-"+Id).addClass("btn-warning");  
                   $("#mc-"+Id).text("lock");
                   $("#s-"+Id).text("Bloquear");

                }else{
                   $("#btn-"+Id).addClass("btn-success");
                   $("#btn-"+Id).removeClass("btn-warning");
                   $("#mc-"+Id).text("work");
                   $("#s-"+Id).text("Habilitar");
                } 

              } else {
              }
            });
                
            }
</script>

@if (session()->has('success'))
    <script type="text/javascript">
    swal("Listo!", "Se ha ingresado un nuevo Usuario!", "success");
    </script>
@endif

@if (session()->has('update'))
    <script type="text/javascript">
    swal("Listo!", "Actualización exisitosa!", "success");
    </script>
@endif
@endsection
