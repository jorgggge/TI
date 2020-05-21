@extends('layouts.app')

@section('content')

<div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-4">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 20px;">nature</i>
                            Areas
                        </div>
                        <div class="body">
                              <div class="row clearfix">
                                <div class="col-sm-12">
                                    <b>Se mostrar las areas registradas de la empresa.</b>
                                </div>
                      
                            </div>
                            @if(empty($areas))
                                <div class="alert alert-danger" >
                                    {{ 'Agrega un área para empezar a trabajar.' }}
                                </div>
                                <center>
                                  <button type="button" class="btn btn-success waves-effect" onclick="CreaArea();">
                                    <i class="material-icons">add</i> <span>Agregar Area</span>
                                  </button>
                                </center>
                            @else
                             <div class="table-responsive">
                                    <table id="dtBasicExampldse2" class="table table-hover">
                                        <thead> 
                                                <tr>
                                                    <th>Área</th>
                                                    <th>
                                                      <button type="button" class="btn btn-success waves-effect" onclick="CreaArea();">
                                                        <i class="material-icons">add</i>
                                                      </button>
                                                    </th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($areas as $area)
                                            <tr>
                                                <td>
                                                  {{$area->name }}
                                                </td>
                                                 <td>      
                                                  <button type="button" class="btn btn-success waves-effect" onclick="Ver_Resultados({{ $area->areaId }},'{{$area->name }}');">
                                                      <i class="material-icons">bar_chart</i>
                                                  </button>
                                            
                                                  <button type="button" class="btn btn-primary waves-effect" onclick="EditarArea({{ $area->areaId }},'{{$area->name }}')">
                                                      <i class="material-icons">edit</i>
                                                  </button>
                                                  <button type="button" class="btn btn-danger waves-effect" onclick="Area_Delete({{ $area->areaId }});">
                                                      <i class="material-icons">clear</i>
                                                  </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>   
                                    </table>
                            </div>
                            @endif
                        </div>
                    </div>
            </div>
            <div class="col-lg-8">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 20px;">bar_chart</i>
                            Resultados
                        </div>
                        <div class="body" id="result_body">
                          <div class="row clearfix">
                            <div class="col-sm-12">
                                <b>
                                  Selecciona una area para ver los resultdos de las pruebas asignadoas. <br>
                                  La notacion del puntaje sera en porcentaje 0% - 100%
                                </b>
                            </div>
                          </div>
                          <div class="row clearfix">
                            <div class="col-sm-12">
                                <table class="table table-hover" id="TableRes">
                                  <thead> 
                                      <tr>
                                          <th>Test</th>
                                          <th>Puntaje (%)</th>
                                          <th>Nivel de madurez</th>
                                      </tr>
                                  </thead>
                                </table>
                          </div>
                          
                          </div>
                          <div style="height: 300px">
                            <canvas id="miGrafico"height="300"></canvas> 
                          </div>
                        </div>
                    </div>
            </div>
</div>


@if (session()->has('success'))
    <script type="text/javascript">
    swal("Listo!", "Se ingresanso los niveles de madurez", "success");
      swal("Listo!", "Ya puedes agregar nuevas areas, pruebas y usuarios", "info");
    </script>
@endif


<script type="text/javascript">

var grafico;
var table;

function Ver_Resultados(Id,Name) {
  $.ajax({
    type: "GET",
    url: "/admin/viewResults/"+Id,
    success: function(response){

      var Test = [];
      var Resultado = [];
      var Nivel = [];
      var color = ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360","#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"];
      var bordercolor = ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'];
            

        var v = JSON.parse(response);

        for (var i = v.length - 1; i >= 0; i--) {
          Test.push(v[i].Test);
          Resultado.push(v[i].Resultado);
          Nivel.push(v[i].Nivel);
        }



         var chartdata = {
                labels: Test,
                datasets: [{
                    label: "Puntaje ",
                    backgroundColor: color,
                    borderColor: color,
                    borderWidth: 2,
                    hoverBackgroundColor: color,
                    hoverBorderColor: bordercolor,
                    data: Resultado
                }]
            };
 
            var mostrar = $("#miGrafico");
 
            if (grafico != null) {
              grafico.clear();
            }
            grafico = new Chart(mostrar, {
                type: 'bar',
                data: chartdata,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false,
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                max: 100,
                                min: 0,
                                beginAtZero: true
                            }
                        }]
                    },
                    title: {
                      display: true,
                      text: 'Puntaje de '+Name
                    }
                }
            });

          if(table != null){
            table.destroy();
          }

          table = $('#TableRes').DataTable({
                data : v,
                "paging":   false,
                "ordering": false,
                "searching": false,
                "info":     false,
                "responsive": true,
                columns: [
                    { 'data': 'Test'},
                    { 'data': 'Resultado'},
                    { 'data': 'Nivel'}
                  ]

            });


    },
    error: function(response){
        console.log(response);
      swal("Lo siento!", "No hay ninguna prueba asignada para esta area.", "error");
    }
  });
}



function  EditarArea(Id,Name) {
    swal("Ingresa el nuevo nombre de "+Name+" a:", {
        content: "input",
      })
      .then((value) => {
         if(value != null && value != ""){
            swal("Espero un momento!", {
                        buttons: false,
                      });
              $.ajax({
                    type: "GET",
                    url: "/admins/area/Edit/editArea/EditArea/"+Id+"/"+value,
                    success: function(response){
                      location.reload(); 
                    }
              });
               
          
         }
        });

      
    }


function Area_Delete(Id) {
            swal({
              title: "Alerta",
              text: "Se eliminar el area con sus pruebas asociadas,   ¿Estas completamente seguro?!",
              icon: "warning",
              buttons: true,
              dangerMode: true
            })
            .then((willDelete) => {
              if (willDelete) {
                window.location = "/admins/area/Edit/editArea/delete/"+Id;
              
              } else {
              }
            });
                
            }
</script>
<script type="text/javascript">
      function  CreaArea() {
        swal("Ingresa la area nueva:", {
            content: "input",
          })
          .then((value) => {
                if(value != null && value != ""){
                  swal("Espero un momento!", {
                      buttons: false,
                    });
                    $.ajax({
                        type: "GET",
                        url: "/AddArea/"+value,
                        success: function(response){
                        
                          location.reload();
                        }
                  });
                }
                
            });
      }
    </script>
@endsection

