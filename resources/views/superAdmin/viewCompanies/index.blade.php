@extends('layouts.app')

@section('content')
@php($count=1)


          
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                       <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 20px;">domain</i>
                            Compañias
                        </div>
                        
                        <div class="body">
                         <b> Se mostrar todas la compañias registradas:</b>
                                
                             <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-hover">
                                   <thead >
                                        <tr>
                                            <th >Empresa</th>
                                            <th >Estado</th>
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
                                                    <td><p style="margin: auto 0px;">{{$C -> name}}</p></td>
                                            <td>
                                                  
                                                    @if ($C->status != 0)
                                                        <button type="button" id="btn-{{ $C->companyId }}" class="btn btn-success waves-effect " onclick="Company_Activa({{ $C->companyId }});">
                                                            <i class="material-icons" id="mc-{{ $C->companyId }}">work</i> <span id="s-{{ $C->companyId }}">Habilitar</span>
                                                        </button>

                                                    @endif
                                                    @if ($C->status == 0)
                                                         <button type="button" id="btn-{{ $C->companyId }}" class="btn btn-warning waves-effect" onclick="Company_Activa({{ $C->companyId }});"> 
                                                            <i class="material-icons" id="mc-{{ $C->companyId  }}" id="s-{{ $C->companyId }}">lock</i> <span id="s-{{ $errors->id }}">Bloquear</span> 
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
                                                    <button class="btn btn-danger">
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
