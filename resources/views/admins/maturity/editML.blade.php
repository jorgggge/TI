@extends('layouts.app')

@section('content')
<body class="Body_SupAdmin container ">

<div class="editml">
	<div class="col-sm-4"></div>
	<div class="col-sm-4 MaturityView">
			<form id="from" method="POST"  action="{{ route('UpdateMaturity')}}">
	        @method('PUT')
	        @csrf
	        @php($count=0)
	        <table class="Table_Customer" id="tAdmin">  <!--TABLA ADMIN-->
	        	@foreach($Comp as $C)
	        	<tr><p class="Title_Maturity">{{$C -> name}}</p></tr>
	        	@endforeach
	        	@foreach ($Mad as $M)
	        	<tr>
	        		<td>{{$count}}</td>
	        		<td><input type="text" name="maturityName[{{ $M->maturityLevelId }}]" id="{{$count}}" class="form-control DescMaturity" readonly value="{{ $M->description}}"></td>
	        	</tr>
	        	@php($count++)
	        	@endforeach			
	        </table>				 		
	    </form>
		<div class="buttContainer">
			<div class="bttns">
	    	<input type="button" value="Editar" class="btn Button_Edit" id="editar" style="background-color: #25A1F9" onclick="ShowButtonMaturity()">
	    	<input type="submit" value="Guardar" class="btn Button_Edit" id="guardar" style="display: none;background-color: #5cb85c" onclick="$('#ModalEditML').modal();">
	    	<input type="button" value="Cancelar" class="btn Button_Edit" id="cancelar" style="display:none;background-color: #d9534f;" onclick="EditMaturity(false)">
		</div>
</div>
	</div>
	<div class="col-sm-4"></div>	
</div>		 
</body>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="ModalEditML">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color: green;color: white;" >
      <div class="modal-header " >
        <h5 class="modal-title"  id="exampleModalLongTitle">Actulizar Nivel de Madurez</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div style="background-color: white;color: black;">
           <center>
             <div class="modal-body" >
                ¿Desea actulizar los datos del Nivel de Madurez?
              </div>
              <div class="update" style="display: none;"><br><h1>Actulizando datos ...</h1></div>
              <div class="spinner-border m-5" role="status" style="display: none;">          
                  <span class="sr-only">Loading...</span>
              </div>
        </center>
      </div>       
      <div class="modal-footer" style="background-color: white;color: black;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="EditMaturity(true)">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="errorDataMaturity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #D9534F;color: white;">
        <h5 class="modal-title" id="exampleModalLongTitle">¡ERROR!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Necesita llenar todos los campos de forma adecuada.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection