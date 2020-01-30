@extends('layouts.app')

@section('content')

<main class="py-4 py-5-mod">
    @foreach ($Area as $A)
    <div class="container contain">
        <div class=" justify-content-center">
            <section class="addArea">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Editar Area</div>
                        <div class="card-body card-pad">
                            <form method="POST" action="{{ route('UpdateArea',[$A->areaId]) }}" id="formEditArea">
                            @method('PUT')
                            @csrf
                            <table class="" id="tAdmin">
                                <tr>
                                    <th id="name">Nombre de Área</th>
                                    <td><input type="text" name="name" id="areaEdi" class="form-control" readonly value="{{ $A->name }}"></td>
                                </tr>
                            </table>
                            </form> 
                            <div id="buttContainer">
                                <div class='bttns'>
                                    <input type="button" value="Editar" class="btn Button_Edit bttn" id="editarA" style="background-color: #25A1F9" onclick="ShowButtonEditArea()">
                                    <input type="button" value="Eliminar" class="btn Button_Edit bttn" id="deleteA" style="background-color: #d9534f" onclick="$('#NoteDeleteArea').modal()">
                                    <input type="submit" value="Guardar" class="btn Button_Edit bttn" id="guardarA" style="display: none;background-color: #5cb85c" onclick="$('#ModalareaE').modal()">
                                    <input type="button" value="Cancelar" class="btn Button Edit bttn" id="cancelarA" style="display:none;background-color: #d9534f;" onclick="EditAreaAD(false)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div> 
</main>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="ModalareaE">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color: green;color: white;" >
      <div class="modal-header " >
        <h5 class="modal-title"  id="exampleModalLongTitle">Actulizar cambios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div style="background-color: white;color: black;">
           <center>
             <div class="modal-body" >
                ¿Desea actulizar los datos del Area?
              </div>
              <div class="update" style="display: none;"><br><h1>Actulizando datos ...</h1></div>
              <div class="spinner-border m-5" role="status" style="display: none;">          
                  <span class="sr-only">Loading...</span>
              </div>
        </center>
      </div>
       
      <div class="modal-footer" style="background-color: white;color: black;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="EditAreaAD(true)">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="NoteDeleteArea">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"style="background-color: #D9534F;color: white;">
      <div class="modal-header ">
        <h5 class="modal-title"  id="exampleModalLongTitle">Elminación de Área</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div style="background-color: white;color: black;">
           <center>
                 <div class="modal-body">
                    ¿Desea eliminar esta área?
                  </div>
                  <div class="update" style="display: none;"><br><h1>Actulizando datos ...</h1></div>
                  <div class="spinner-border m-5" role="status" style="display: none;">          
                      <span class="sr-only">Loading...</span>
                  </div>
            </center>
       </div>
      <div class="modal-footer" style="background-color: white;color: black;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="window.location='{{ route('DeleteArea',$A->areaId) }}'">Aceptar</button>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- Modal -->
<div class="modal fade" id="errorDataArea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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