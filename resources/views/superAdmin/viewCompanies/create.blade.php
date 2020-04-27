@extends('layouts.app')

@section('content')
@php($count=1)

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
                        <div class="header " style="background-color: #112d4e;">
                            <h2 style="color: white;">
                                Compañias
                            </h2>
                           
                        </div>
                        
                        <div class="body">
                         <div class="row clearfix">
                                <div class="col-sm-4">
                                    <h5>Se mostrar todas la compañias registradas:</h5>

                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                         <span class="input-group-addon">
                                            <i class="material-icons">search</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" id="myInput" class="form-control" placeholder="Buscar Compañia" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-hover">
                                   <thead >
                                        <tr>
                                            <th >Estado</th>
                                            <th >Empresa</th>
                                            <th >Direccion</th>
                                            <th >Telefono</th>
                                            <th >Correo</th>
                                            <th >Registro</th>
                                        </tr>
                                    </thead>
                                    <tbody id="Mytable" >
                                    @foreach($Com as $C)
                                        @if($C->companyId != 1)
                                        <tr>
                                            <td>
                                                <form class='viewCompany form'  method="POST" action="{{ route('status',$C->companyId) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    @if ($C->status != 0)
                                                        <button type="button" class="btn btn-success waves-effect " onclick="Company_Activa({{ $C->companyId }}, 0);">
                                                            Habilitado
                                                        </button>

                                                    @endif
                                                    @if ($C->status == 0)
                                                         <button type="button" class="btn btn-warning waves-effect" onclick="Company_Activa({{ $C->companyId }}, 1);"> 
                                                            Deshabilitado
                                                        </button>
                                                    @endif
                                                </form>
                                                </td>
                                                    <td>{{$C -> name}}</td>
                                                    <td>{{$C -> address}}</td>
                                                    <td>{{$C -> phoneNumber}}</td>
                                                    <td>{{$C -> email}}</td>
                                                    <td><a href="{{ route('ShowCompanySA',$C->companyId) }}" class="btn btn-primary waves-effect">
                                                        Editar
                                                    </a></td>
                                        </tr>
                                        @endif
                                        @php($count++)
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
<script src="{{ asset('js/code.js') }}"></script>

<script type="text/javascript">
    $("#Company").addClass('active');
    $("#CompanySee").addClass('active');


    function Company_Activa(Id,A) {
swal({
  title: "Atecion",
  text: "Se cambiara el status de este compañia, Estas seguro?!",
  icon: "warning",
  buttons: true,
  dangerMode: true
})
.then((willDelete) => {
  if (willDelete) {
    window.location = "/superAdmin/companydelete/delete/"+Id+"/"+A;
  
  } else {
  }
});
    
}
</script>
@endsection
