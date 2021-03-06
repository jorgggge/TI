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
                            @if(empty($areas))
                                <div class="alert alert-danger" >
                                    {{ 'No se ha asignado una Área. Por favor aviso esto a su supervisor.' }}
                                </div>
                            @else
                            <b>Se mostrar las áreas asignados para el usuario.</b><br><br>
                             <div class="table-responsive">
                                    <table id="" class="table table-hover">
                                        <thead> 
                                                <tr>
                                                    <th>Área</th>
                                                    <th>Resultados</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($areas as $area)
                                            <tr>
                                                <td>{{$area->name}}</td>
                                                <td> 
                                                    <button type="button" class="btn btn-success waves-effect" onclick="Ver_Resultados({{ $area->areaId }},'{{$area->name }}');">
                                                      <i class="material-icons">bar_chart</i>
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
                                  Selecciona una área para ver los resultados de las pruebas asignados. <br>
                                  La notación del puntaje sera en porcentaje 0% - 100%
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
                              <canvas id="miGrafico"></canvas>
                          </div> 
          
                        </div>
                    </div>
            </div>
</div>

</div>



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
                columns: [
                    { 'data': 'Test'},
                    { 'data': 'Resultado'},
                    { 'data': 'Nivel'}
                  ]
            });


    },
    error: function(response){
        console.log(response);
      swal("Lo siento!", "No hay ninguna prueba asignada para esta área.", "error");
    }
  });
}

</script>
@endsection


