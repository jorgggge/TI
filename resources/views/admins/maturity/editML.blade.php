@extends('layouts.app')

@section('content')
<div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 24px;">insert_chart</i>
                            Niveles de Madurez
                        </div>
                        <div class="body">
                          Aqui podras editar los nombres de los niveles de madurez.
                                <br> <b>(*) Datos Obligatorios.</b>
                          <form id="from" method="POST"  action="{{ route('UpdateMaturity')}}">
                        @csrf
                        @php($count=0)
                        @foreach ($Mad as $M)
                      	 <div class="row clearfix">
                          
                          <div class="col-sm-2"></div>
                           <div class="col-sm-8">
                                    <p>
                                        <b>* Nivel {{ ($count) + 1}}</b>
                                    </p>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <i class="material-icons">insert_chart</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" name="maturityName{{ $M->maturityLevelId }}" id="{{$count}}" class="form-control" placeholder="Nivel" required value="{{ $M->description}}">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        @php($count++)
                        @endforeach     
                      </form>   
                        <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                <div class="col-sm-8">
                                </div>
                                <div class="col-sm-2">
                                     <button class="btn btn-info" id="btn-form" type="submit">
                                       <i class="material-icons">done</i> <span>Guardar</span> 
                                     </button>
                                </div>
                            </div>
                           

                          </div> 
                         </div>
                      </div>		 
                    </div>
                  </div>
                </div>
              </div>

<script type="text/javascript">
  
$("#NivelesdeMadurez").addClass('active');

$("#btn-form").click(function(){
        swal({
          title: "Atención",
          text: "Se actualizara los datos los niveles de madurez,¿Estas seguro?",
          icon: "warning",
          buttons: ["Cancelar", "Si"],
          dangerMode: true
        })
        .then((willDelete) => {

            if (willDelete) {

                $( "input[type='text']" ).each(function() {
                    $( this ).css('border-color','#1F91F3');
                });
                

                $.ajax({
                    url: "/admins/maturity/editML",
                    type:"POST",
                    data:{
                        maturityName1:  $("input[name=maturityName1]").val(),
                        maturityName2:  $("input[name=maturityName2]").val(),
                        maturityName3:  $("input[name=maturityName3]").val(),
                        maturityName4:  $("input[name=maturityName4]").val(),
                        maturityName5:  $("input[name=maturityName5]").val(),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },

                    success:function(response){
                      swal("Actualización", "Se ha actulizado los datos correctamente!", "success");
                    },
                    error:function(response){

                        var v = JSON.parse(response.responseText);

                        $.each(v.errors,function(index, value){
                            $("input[name="+index+"]").css('border-color','red');
                        });
                        
                      swal("Error", "Verifique los datos antes de actualizar", "error");
                    }
                   });

            }
           
        });

    });
</script>
@endsection