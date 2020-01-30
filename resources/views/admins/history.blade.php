@extends('layouts.app')

@section('content')

	<div class="container" >
        <div class="row justify-content-center">
            <div class="col-11">
            	<form method="POST" action="{{ route('HistoryDeleteA') }}" id="fromhistory">
					@method('PUT')
					@csrf
            		<input type="button" class="btn btn-danger Button_Edit" name="delete" value="Borrar Registro" onclick="$('#NoteDeleteHitorial').modal();" style="width: 100px;">
            	</form>
                <table class="table table-borderless table-hover">
				  <thead style="background: #112d4e;color: white;">
				    <tr>
				      
				      <th scope="col">Usurario</th>
				      <th scope="col">Acción</th>
				      <th scope="col">Fecha</th>
				    </tr>
				  </thead>
				  <tbody style="background: white;">
				   
				      @foreach ($Historial as $History)
				       <tr>
				      	<td>{{ $History->username}}</td>
				      	<td>{{ $History->action }}</td>
				      	<td>{{ $History->date }}</td>
				      	
				      	</tr>
				      @endforeach
				    
				  </tbody>
				</table>

            </div>
        </div>
    </div>

<div class="modal show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="NoteDeleteHitorial">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"style="background-color: #D9534F;color: white;">
      <div class="modal-header ">
        <h5 class="modal-title"  id="exampleModalLongTitle">Elminación del Historial</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div style="background-color: white;color: black;">
           <center>
                 <div class="modal-body">
                    ¿Desea eliminar los datos del Historial?
                  </div>
            </center>
       </div>
      <div class="modal-footer" style="background-color: white;color: black;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="DeleteHistory();">Aceptar</button>
      </div>
    </div>
  </div>
</div>

@endsection