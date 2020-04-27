@extends('layouts.app')

@section('content')

<div class="container-fluid">
<div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">
                               @foreach($Comp as $C)
                                <p id="title_test">{{$C -> name}}</p>
                                @endforeach
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-2"> 
                                    <input type="button" id="back_area" class="btn btn-primary" value="Regresar" style="display:none;" onclick="BackAreaTest()">
                                </div>
                                <div class="col-sm-2"> 
                                    <input type="button" id="editTest" class="btn btn-primary" value="Editar" style="display:none;" onclick="ShowEditar()">
                                </div>
                                <div class="col-sm-2">
                                    <input type="button" id="deleteTest" class="btn btn-primary" value="Eliminar" style="display:none;" onclick="$('#NoteDeleteTest').modal();"> 
                                </div>
                                <div class="col-sm-2">
                                    <input type="button" id="SaveTest" class="btn btn-primary" value="Guardar" style="display:none;" onclick="$('#NoteUpdate').modal();">
                                </div>
                                <div class="col-sm-2">
                                     <input type="button" id="CancelTest" class="btn btn-primary" value="Cancelar" style=" display:none;" onclick="EditarTest(false)">
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-10">
                                    <form id="form_Etest" method="POST" action="{{ url('/admins/area/test/edit')}}">
                                    @method('PUT')
                                    @csrf
                                    <div id="Area_testShow" class="Area_testShow-Test">
                                        <label>Área:</label>
                                        <select class="form-control show-tick" id="area_test" name="area_test">
                                            <option value="X">--Selección de Área--</option>
                                            @foreach($Area as $A)
                                            <option value="{{$A -> areaId}}">{{$A -> name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                                </div>
                            </div>
        <form id="test">
            <div id="show_Test" style="display: none;">
                <table class='eval'>
                    <tr class='heady'>

                        <td><label>Prueba</label></td>
                        <td id="nameTestS">
                            <select type='text' class="form-control show-tick" id="list_test">                          
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="NoteLoad">
  <div class="modal-dialog" role="document">
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
  <div class="modal-dialog" role="document">
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

<div class="modal face" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="NoteDeleteTest">
  <div class="modal-dialog" role="document">
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


<div class="modal face" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="NoteNada">
  <div class="modal-dialog" role="document">
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

<div class="modal face" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="NoteError">
  <div class="modal-dialog" role="document">
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
