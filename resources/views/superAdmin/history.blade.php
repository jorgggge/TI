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
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 20px;">
                            
                                Historial
                           
                        </div>
                        
                        <div class="body">
                         <div class="row clearfix">
                               <div class="col-sm-10">
                                   <b>Se mostrar todas las acciones por parte de los usuarios.</b>
                               </div>
                                 <div class="col-sm-2">
                                    
                                        <form action="{{ route('HistoryDelete') }}" id="fromhistory" method="POST">
											@csrf
						            		<input type="button" class="btn btn-lg btn-danger waves-effect" name="delete" value="Borrar Registro" onclick="DeleteHistory();">
						            	</form>
                                </div>
                                
                            </div>
                            <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-hover">
                                	<thead>
									    <tr>

									      <th>Usurario</th>
									      <th>Empresa</th>
									      <th>Acción</th>
									      <th>Fecha</th>

									    </tr>
									  </thead>
									  <tbody style="background: white;">

									      @foreach ($Historial as $History)
									       <tr>
									      	<td>{{ $History->username}}</td>
									      	<td>{{ $History->company }}</td>
									      	<td>{{ $History->action }}</td>
									      	<td>{{ $History->date }}</td>

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


@if (session()->has('success'))
    <script type="text/javascript">
    swal("Listo!", "Se ha borrado el historial!", "success");
    </script>
@endif

@endsection
