@extends('layouts.app')

@section('content')
<div class='MainCompany'>
    @foreach ($Admin as $A)
        <div class="CompanySA">
                <p>{{ $A->name }}</p>
                @if ( session('mensaje') )
                <div class="alert alert-success" class='message' id='message'>{{ session('mensaje') }}</div>
                @endif
                @can('update')

                <form method="POST" action="{{ route('DeleteCustomer',$A->companyId) }}">
                    @method('PUT')
                    @csrf
                    @if ($A->status == 1)
                        @if ($A->companyId == 1)
                        @else
                            <input type="text" name="status" style="width: 0px;border:none; " readonly value="0">
                            <input type="submit" value="Deshabilitar" class="btn" style="background-color: red;color:white;">
                        @endif
                    @endif
                    @if ($A->status != 1)
                        @if ($A->companyId == 1)
                        @else
                            <input type="text" name="status" style="width: 0px;border:none; " readonly value="1">
                            <input type="submit" value="Habilitar" class="btn" style="background-color: #5cb85c;color:white;">
                        @endif
                    @endif
                </form>
                @endcan
        </div>
            <!--TABLES-->
            <form id="formCompany" method="POST" action="{{  route('EditCompanySA',[$A->companyId]) }}">
                @method('PUT')
                @csrf
                <table class="Table_ECompany" id="EditCompany_SA">
                    <!--TABLA EMPRESA-->
                    <tr>
                        <th>Empresa</th>
                        <td><input type="text" name="name" id="nameC" class="form-control" readonly value="{{ $A->name }}"></td>
                    </tr>
                    <tr>
                        <th>Dirección</th>
                        <td><input type="text" name="address" id="addressC" class="form-control" readonly value="{{ $A->address }}">
                        </td>
                    </tr>
                    <tr>
                        <th>Teléfono</th>
                        <td><input type="text" name="phoneNumber" id="phoneNumberC" class="form-control" readonly
                                value="{{ $A->phoneNumber }}"></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input type="text" name="email" id="emailC" class="form-control" readonly
                                value="{{ $A->email }}"></td>
                    </tr>
                </table>
            </form>
            @can('update')
            <div id="buttContainer" class="BtnClassCompany">
            	<div class='bttns'>
                    <input type="button" value="Editar" class="btn Button_Edit bttn" id="editar"
                    style="background-color: #25A1F9" onclick="ShowButtonCompany()">
                    <input type="submit" value="Guardar" class="btn Button_Edit bttn" id="guardar"
                    style="display: none;background-color: #5cb85c" onclick="EditCompany(true)">
                    <input type="button" value="Cancelar" class="btn Button Edit bttn" id="cancelar"
                    style="display:none;background-color: #d9534f;" onclick="EditCompany(false)">
                </div>
            </div>
            @endcan
    @endforeach
</div>
<!-- Modal -->
<div class="modal fade" id="errorDataCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #D9534F;color: white;">
        <h5 class="modal-title" id="exampleModalLongTitle">¡ERROR!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Necesita llenar todos los campos de forma adecuada
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
