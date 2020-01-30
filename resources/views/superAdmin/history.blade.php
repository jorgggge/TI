@extends('layouts.app')

@section('content')

	<div class="container" >
        <div class="row justify-content-center">
            <div class="col-11">
            	<form method="POST" action="{{ route('HistoryDelete') }}" id="fromhistory">
					@method('PUT')
					@csrf
            		<input type="button" class="btn btn-danger Button_Edit" name="delete" value="Borrar Registro" onclick="DeleteHistory();">
            	</form>
                <table class="table table-borderless table-hover">
				  <thead style="background: #112d4e;color: white;">
				    <tr>

				      <th scope="col">Usurario</th>
				      <th scope="col">Empresa</th>
				      <th scope="col">Acción</th>
				      <th scope="col">Fecha</th>

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

@endsection
