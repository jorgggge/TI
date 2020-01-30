@extends('layouts.app')

@section('content')

<main class="py-4 py-5-mod">
    <div class="container contain">
        <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
    <div class="card-header">
            @foreach($Comp as $C)
            <p id="title_test">{{$C -> name}}</p>
            @endforeach
        </div>
        <div class="buttContainer">
            <div class='bttns'>
        <input type="button" id="back_area" class="btn Button_Edit bttn" value="Regresar"
            style="background-color: #25A1F9; display:none;" onclick="BackAreaTest()">
        <input type="button" id="editTest" class="btn Button_Edit bttn" value="Editar" style="background-color: #25A1F9; display:none;"
            onclick="ShowEditar()">
        <input type="button" id="deleteTest" class="btn Button_Edit bttn" value="Eliminar" style="background-color: #d9534f; display:none;"
            onclick="$('#NoteDeleteTest').modal();">            
        <input type="button" id="SaveTest" class="btn Button_Edit bttn" value="Guardar" style="background-color: #5cb85c; display:none;"
            onclick="$('#NoteUpdate').modal();">
        <input type="button" id="CancelTest" class="btn Button_Edit bttn" value="Cancelar"
            style="background-color: #d9534f; display:none;" onclick="EditarTest(false)">
            </div>
        </div>
        <form id="form_Etest" method="POST" action="{{ url('/admins/area/test/edit')}}">
            @method('PUT')
            @csrf
            <div id="Area_testShow" class="Area_testShow-Test">
                <label>Área:</label>
                <select class="form-control" id="area_test" name="area_test">
                    <option value="X">--Selección de Área--</option>
                    @foreach($Area as $A)
                    <option value="{{$A -> areaId}}">{{$A -> name}}</option>
                    @endforeach
                </select>
            </div>
        </form>
        <form id="test">
            <div id="show_Test" style="display: none;">
                <table class='eval'>
                    <tr class='heady'>

                        <td><label>Prueba</label></td>
                        <td id="nameTestS">
                            <select type='text' class="form-control" id="list_test">
                            </select>
                        </td>
                        <td style="display: none;" id="nameTest"><input type="text" id="nameTests" name="nameTest"
                                class="form-control"></td>
                    </tr>
                    <tr class='heady'>
                        <td><label>Usuario</label></td>
                        <td style="display: none;" id="nameUserS">
                            <select type='text' class="form-control" id="list_users">
                            </select>
                        </td>
                        <td  id="nameUser"><input type="text" id="nameUsers"
                                name="nameConcept" class="form-control" readonly></td>
                    </tr>
                    <tr class='heady'>
                        <td><label>Concepto</label></td>
                        <td id="nameConceptS">
                            <select type='text' class="form-control" id="list_concept">
                                <option value="">--Selección de Concepto--</option>
                            </select>
                        </td>
                        <td style="display: none;" id="nameConcept"><input type="text" id="nameConcepts"
                                name="nameConcept" class="form-control"></td>
                    </tr>
                    <tr class='heady'>
                        <!--Atributo1-->
                        <td  class='bold' id="address addy" colspan="2">Nivel de Madurez: <label id="0" style="font-weight: bold"></label></td>
                    </tr>
                    <tr class="border">
                        <!--Se puede ciclar para los 3 atributos correspondientes-->
                        <td>
                            <center><label class="">Atributo</label></center>
                        </td>
                        <td colspan="2"><input type="hidden" name="custId" value=""><input type="text" id="00"
                                name="atributo" class="form-control" readonly></td>
                    </tr>
                    <tr class="border">
                        <!--Se puede ciclar para los 3 atributos correspondientes-->
                        <td>
                            <center><label class="">Atributo</label></center>
                        </td>
                        <td colspan="2"><input type="hidden" name="custId" value=""><input type="text" id="01"
                                name="atributo" class="form-control" readonly></td>
                    </tr>
                    <tr class="border">
                        <!--Se puede ciclar para los 3 atributos correspondientes-->
                        <td>
                            <center><label class="">Atributo</label></center>
                        </td>
                        <td colspan="2"><input type="hidden" name="custId" value=""><input type="text" id="02"
                                name="atributo" class="form-control" readonly></td>
                    </tr>
                    <tr class='heady'>
                        <!--Atributo1-->
                        <td  class='bold' id="address addy" colspan="2">Nivel de Madurez: <label id="1" style="font-weight: bold"></label></td>
                    </tr>
                    <tr class="border">
                        <!--Se puede ciclar para los 3 atributos correspondientes-->
                        <td>
                            <center><label class="">Atributo</label></center>
                        </td>
                        <td colspan="2"><input type="hidden" name="custId" value=""><input type="text" id="10"
                                name="atributo" class="form-control" readonly></td>
                    </tr>
                    <tr class="border">
                        <!--Se puede ciclar para los 3 atributos correspondientes-->
                        <td>
                            <center><label class="">Atributo</label></center>
                        </td>
                        <td colspan="2"><input type="hidden" name="custId" value=""><input type="text" id="11"
                                name="atributo" class="form-control" readonly></td>
                    </tr>
                    <tr class="border">
                        <!--Se puede ciclar para los 3 atributos correspondientes-->
                        <td>
                            <center><label class="">Atributo</label></center>
                        </td>
                        <td colspan="2"><input type="hidden" name="custId" value=""><input type="text" id="12"
                                name="atributo" class="form-control" readonly></td>
                    </tr>
                    <tr class='heady'>
                        <!--Atributo1-->
                        <td  class='bold' id="address addy" colspan="2">Nivel de Madurez: <label id="2" style="font-weight: bold"></label></td>
                    </tr>
                    <tr class="border">
                        <!--Se puede ciclar para los 3 atributos correspondientes-->
                        <td>
                            <center><label class="">Atributo</label></center>
                        </td>
                        <td colspan="2"><input type="hidden" name="custId" value=""><input type="text" id="20"
                                name="atributo" class="form-control" readonly></td>
                    </tr>
                    <tr class="border">
                        <!--Se puede ciclar para los 3 atributos correspondientes-->
                        <td>
                            <center><label class="">Atributo</label></center>
                        </td>
                        <td colspan="2"><input type="hidden" name="custId" value=""><input type="text" id="21"
                                name="atributo" class="form-control" readonly></td>
                    </tr>
                    <tr class="border">
                        <!--Se puede ciclar para los 3 atributos correspondientes-->
                        <td>
                            <center><label class="">Atributo</label></center>
                        </td>
                        <td colspan="2"><input type="hidden" name="custId" value=""><input type="text" id="22"
                                name="atributo" class="form-control" readonly></td>
                    </tr>
                    <tr class='heady'>
                        <!--Atributo1-->
                        <td  class='bold' id="address addy" colspan="2">Nivel de Madurez: <label id="3" style="font-weight: bold"></label></td>
                    </tr>
                    <tr class="border">
                        <!--Se puede ciclar para los 3 atributos correspondientes-->
                        <td>
                            <center><label class="">Atributo</label></center>
                        </td>
                        <td colspan="2"><input type="hidden" name="custId" value=""><input type="text" id="30"
                                name="atributo" class="form-control" readonly></td>
                    </tr>
                    <tr class="border">
                        <!--Se puede ciclar para los 3 atributos correspondientes-->
                        <td>
                            <center><label class="">Atributo</label></center>
                        </td>
                        <td colspan="2"><input type="hidden" name="custId" value=""><input type="text" id="31"
                                name="atributo" class="form-control" readonly></td>
                    </tr>
                    <tr class="border">
                        <!--Se puede ciclar para los 3 atributos correspondientes-->
                        <td>
                            <center><label class="">Atributo</label></center>
                        </td>
                        <td colspan="2"><input type="hidden" name="custId" value=""><input type="text" id="32"
                                name="atributo" class="form-control" readonly></td>
                    </tr>
                    <tr class='heady'>
                        <!--Atributo1-->
                        <td  class='bold' id="address addy" colspan="2">Nivel de Madurez: <label id="4" style="font-weight: bold"></label></td>
                    </tr>
                    <tr class="border">
                        <!--Se puede ciclar para los 3 atributos correspondientes-->
                        <td>
                            <center><label class="">Atributo</label></center>
                        </td>
                        <td colspan="2"><input type="hidden" name="custId" value=""><input type="text" id="40"
                                name="atributo" class="form-control" readonly></td>
                    </tr>
                    <tr class="border">
                        <!--Se puede ciclar para los 3 atributos correspondientes-->
                        <td>
                            <center><label class="">Atributo</label></center>
                        </td>
                        <td colspan="2"><input type="hidden" name="custId" value=""><input type="text" id="41"
                                name="atributo" class="form-control" readonly></td>
                    </tr>
                    <tr class="border">
                        <!--Se puede ciclar para los 3 atributos correspondientes-->
                        <td>
                            <center><label class="">Atributo</label></center>
                        </td>
                        <td colspan="2"><input type="hidden" name="custId" value=""><input type="text" id="42"
                                name="atributo" class="form-control" readonly></td>
                    </tr>
                </table>

            </div>
        </form>
    </div>
    <div id="TestReload" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">¡ACTUALIZACIÓN DE TEST!</h4>
                </div>
                <div class="modal-body">
                    <p>Se actualizó de forma correcta el Test.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" style="background-color: #5cb85c"
                        data-dismiss="modal">ACEPTAR</button>
                </div>
            </div>

        </div>
    </div>
 </div>
                </div>
        </div>
    </div>
</main>

<div class="modal show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="NoteLoad">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"style="background-color: #3f72af;color: white;">
      <div class="modal-header ">
        <h5 class="modal-title"  id="exampleModalLongTitle">Cargando ...</h5>
       
      </div>
       <div style="background-color: white;color: black;">
           <center>
                  <div class="update" ><br><h1>Cargando datos ...</h1></div>
                  <div class="spinner-border m-5" role="status">          
                      <span class="sr-only">Loading...</span>
                  </div>
            </center>
       </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="NoteUpdate">
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
                ¿Desea actulizar los datos del test?
              </div>
              <div class="update" style="display: none;"><br><h1>Actulizando datos ...</h1></div>
              <div class="spinner-border m-5" role="status" style="display: none;">          
                  <span class="sr-only">Loading...</span>
              </div>
        </center>
      </div>
       
      <div class="modal-footer" style="background-color: white;color: black;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="EditarTest(true);">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="NoteDeleteTest">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"style="background-color: #D9534F;color: white;">
      <div class="modal-header ">
        <h5 class="modal-title"  id="exampleModalLongTitle">Elminación de Test</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div style="background-color: white;color: black;">
           <center>
                 <div class="modal-body">
                    ¿Desea eliminar este test?
                  </div>
                  <div class="update" style="display: none;"><br><h1>Actulizando datos ...</h1></div>
                  <div class="spinner-border m-5" role="status" style="display: none;">          
                      <span class="sr-only">Loading...</span>
                  </div>
            </center>
       </div>
      <div class="modal-footer" style="background-color: white;color: black;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="DeleteTest()">Aceptar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="NoteNada">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"style="background-color: #D9534F;color: white;">
      <div class="modal-header ">
        <h5 class="modal-title"  id="exampleModalLongTitle">Atención</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div style="background-color: white;color: black;">
           <center>
                 <div class="modal-body">
                    No hay test asignados a esta Area
                  </div>
            </center>
       </div>
    </div>
  </div>
</div>

<div class="modal show" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="NoteError">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content"style="background-color: #D9534F;color: white;">
      <div class="modal-header ">
        <h5 class="modal-title"  id="exampleModalLongTitle">Atención</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div style="background-color: white;color: black;">
           <center>
                 <div class="modal-body">
                    Hay campos vacios, por favor de verificar los datos ... 
                  </div>
            </center>
       </div>
    </div>
  </div>
</div>
@endsection
