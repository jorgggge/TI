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
                                Historial
                            </h2>
                            <ul class="header-dropdown m-r-0">
                                <li>
                                    <a href="javascript:void(0);">
                                        <i class="material-icons">info_outline</i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <i class="material-icons">help_outline</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="body">
                         <div class="row clearfix">
                                <div class="col-sm-4">
                                    
                                        <form method="POST" action="{{ route('HistoryDelete') }}" id="fromhistory">
											@method('PUT')
											@csrf
						            		<input type="button" class="btn btn-lg btn-danger waves-effect" name="delete" value="Borrar Registro" onclick="DeleteHistory();">
						            	</form>
                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4"></div>
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


@endsection
