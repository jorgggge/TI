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
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 20px;">
                                Compañias
                           
                        </div>
                        
                        <div class="body">
                         <div class="row clearfix">
                                <div class="col-sm-12">
                                    <h5>Se mostrar todas la compañias registradas:</h5>

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
                                    <tbody id="myTable" >
                                    @foreach($Com as $C)
                                        @if($C->companyId != 1)
                                        <tr>
                                            <td>
                                                <form class='viewCompany form'  method="POST" action="{{ route('status',$C->companyId) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    @if ($C->status != 0)
                                                        <button type="button" id="btn-{{ $C->companyId }}" class="btn btn-success waves-effect " onclick="Company_Activa({{ $C->companyId }});" style="width: 100%;">
                                                            <i class="material-icons" id="mc-{{ $C->companyId }}">work</i> <span id="s-{{ $C->companyId }}">Habilitar</span>
                                                        </button>

                                                    @endif
                                                    @if ($C->status == 0)
                                                         <button type="button" id="btn-{{ $C->companyId }}" class="btn btn-warning waves-effect" onclick="Company_Activa({{ $C->companyId }});" style="width: 100%;"> 
                                                            <i class="material-icons" id="mc-{{ $C->companyId  }}" id="s-{{ $C->companyId }}">lock</i> <span id="s-{{ $errors->id }}">Bloquear</span> 
                                                        </button>
                                                    @endif
                                                </form>
                                                </td>
                                                    <td><p style="margin: auto 0px;">{{$C -> name}}</p></td>
                                                    <td>{{$C -> address}}</td>
                                                    <td>{{$C -> phoneNumber}}</td>
                                                    <td>{{$C -> email}}</td>
                                                    <td><a href="{{ route('ShowCompanySA',$C->companyId) }}" class="btn btn-primary waves-effect" >
                                                        <i class="material-icons">mode_edit</i> <span>Editar</span> 
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


    function Company_Activa(Id) {
        swal({
              title: "Atención",
              text: "Se cambiara el status de esta compañia, ¿Estas seguro?",
              icon: "warning",
              buttons: ["Cancelar", "Si"],
              dangerMode: true
            })
            .then((willDelete) => {
              if (willDelete) {
              
                A = $("#btn-"+Id).hasClass("btn-success") ? 0 : 1;

                $.ajax({
                  type: "GET",
                  url: "/superAdmin/companydelete/delete/"+Id+"/"+A,
                  success: function(response) {
                    
                  }
                });

                if(A == 0){
                   $("#btn-"+Id).removeClass("btn-success");
                   $("#btn-"+Id).addClass("btn-warning");  
                   $("#mc-"+Id).text("lock");
                   $("#s-"+Id).text("Bloquear");

                }else{
                   $("#btn-"+Id).addClass("btn-success");
                   $("#btn-"+Id).removeClass("btn-warning");
                   $("#mc-"+Id).text("work");
                   $("#s-"+Id).text("Habilitar");
                } 

              } else {
              }
            });
    
    }
</script>
@endsection
