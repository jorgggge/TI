@extends('layouts.app')

@section('content')
@php($count=1)


          
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                       <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 20px;">domain</i>
                            Compañías
                        </div>
                        
                        <div class="body">
                         <b> Se mostrar todas la compañías registradas:</b>
                                
                             <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-hover">
                                   <thead >
                                        <tr>
                                            <th >Empresa</th>
                                            <th >Estado</th>
                                            <th >Dirección</th>
                                            <th >Teléfono</th>
                                            <th >Correo</th>
                                            <th >Registro</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable" >
                                    @foreach($Com as $C)
                                        @if($C->companyId != 1)
                                        <tr>
                                                    <td><p style="margin: auto 0px;">{{$C -> name}}</p></td>
                                            <td>
                                                  
                                                    @if ($C->status == 0)
                                                        <button type="button" id="btn-{{ $C->companyId }}" class="btn btn-success waves-effect " onclick="Company_Activa({{ $C->companyId }});">
                                                            <i class="material-icons" id="mc-{{ $C->companyId }}">work</i> <span id="s-{{ $C->companyId }}">Habilitar</span>
                                                        </button>

                                                    @endif
                                                    @if ($C->status == 1)
                                                         <button type="button" id="btn-{{ $C->companyId }}" class="btn btn-warning waves-effect" onclick="Company_Activa({{ $C->companyId }});"> 
                                                            <i class="material-icons" id="mc-{{ $C->companyId  }}">lock</i> <span id="s-{{$C->companyId  }}">Bloquear</span> 
                                                        </button>
                                                    @endif
                                                </td>
                                                    <td>{{$C -> address}}</td>
                                                    <td>{{$C -> phoneNumber}}</td>
                                                    <td>{{$C -> email}}</td>
                                                    <td>
                                                      <a href="{{ route('ShowCompanySA',$C->companyId) }}" class="btn btn-primary waves-effect" >
                                                        <i class="material-icons">mode_edit</i>
                                                    </a>
                                                    <button class="btn btn-danger" onclick="Company_Delete({{ $C->companyId }});">
                                                      <i class="material-icons">clear</i>
                                                    </button>
                                                  </td>
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
           
            <!-- #END# Basic Examples -->
        
<script src="{{ asset('js/code.js') }}"></script>

@if (session()->has('successAddCompany'))
    <script type="text/javascript">
    swal("Listo!", "Se ha ingresado una nueva compañía!", "success");
    </script>
@endif



<script type="text/javascript">

    function Company_Delete(Id) {
        swal({
              title: "Atención",
              text: "Se eliminara esta compañía, ¿Estas seguro?",
              icon: "warning",
              buttons: ["Cancelar", "Si"],
              dangerMode: true
            })
            .then((willDelete) => {
              if (willDelete) {

                $.ajax({
                  type: "GET",
                  url: "/superadmin/company/delete/"+Id,
                  success: function(response) {
                       swal({
                        title: "Espere un momento ...",
                        text: "Se cerrara automáticamente",
                        buttons: false
                        });
                    location.reload();
                  },
                  error: function(response) {
                    console.log(response);
                  }
                });

                }
            });
    
    }



    $("#Company").addClass('active');
    $("#CompanySee").addClass('active');


    function Company_Activa(Id) {
        swal({
              title: "Atención",
              text: "Se cambiara el estatus de esta compañía, ¿Estas seguro?",
              icon: "warning",
              buttons: ["Cancelar", "Si"],
              dangerMode: true
            })
            .then((willDelete) => {
              if (willDelete) {
              
                A = $("#btn-"+Id).hasClass("btn-success") ? 1 : 0;

                $.ajax({
                  type: "GET",
                  url: "/superAdmin/companydelete/delete/"+Id+"/"+A,
                  success: function(response) {
                    
                  }
                });

                if(A == 1){
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
