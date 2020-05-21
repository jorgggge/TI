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
                        <div class="body">

                            @if(empty($Test))
                                <div class="alert alert-danger" >
                                    <h4>Por el momento no tienes ninguna prueba asignada, contacta a tu administrador para que se asigne una.</h4>
                                </div>
                            @else
                             <div class="">
                             	Se mostrar todas las pruebas asignadas para usted. <br><br>
                                    <table id="dtBasicExample" class="table">
                                        <thead> 
                                                <tr>
                                                    <th>Prueba</th>
                                                    <th>Concepto</th>
                                                    <th style="width: 60%;">Progeso</th>
                                                    <th style="width: 20%;">Realizar</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($Test as $T)
                                            <tr>
                                            	<td>
                                            		{{ $T['Test'] }}
                                            	</td>
                                                <td>
                                                    {{ $T['Concept'] }}
                                                </td>
                                            	<td>
                                            		@if ($T['Progress'] >=0 && $T['Progress'] < 25)
							                            <div class="progress">
							                                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="80" aria-valuemin="0"
							                                     aria-valuemax="100" style="width: {{ $T['Progress'] }}%">
							                                </div>
							                            </div>
                                            		@endif
                                            		@if ($T['Progress'] >=  25 && $T['Progress'] < 50)
							                            <div class="progress">
							                                <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0"
							                                     aria-valuemax="100" style="width: {{ $T['Progress'] }}%">
							                                </div>
							                            </div>
                                            		@endif
                                            		@if ($T['Progress'] >= 50 && $T['Progress'] < 75)
							                            <div class="progress">
							                                <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0"
							                                     aria-valuemax="100" style="width: {{ $T['Progress'] }}%">
							                                </div>
							                            </div>
                                            		@endif
                                            		@if ($T['Progress'] >= 75)
	                                            		<div class="progress">
	                                						<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="{{ $T['Progress'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $T['Progress'] }}%"></div>
	                            						</div>
                                            		@endif
                                            	</td>
                                            	<td>
                                            		<button class="btn btn-primary" onclick="window.location='/comun/prueba/{{ $T['TestId'] }}/{{ $T['ConceptId'] }}'">
                                            			<i class="material-icons">edit</i> <span>Realizar Prueba</span>
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