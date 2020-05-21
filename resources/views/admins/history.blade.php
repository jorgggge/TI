@extends('layouts.app')

@section('content')
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
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 24px;">history</i>
                           Historial
                        </div>
                        
                        <div class="body">
                         <div class="row clearfix">
                            <div class="col-sm-4">
                              <b>Aqui se mostrar las acciones generadas por los usuarios.</b>
                            </div>
                          </div>
                          <div class="table-responsive">
                                <table id="dtBasicExamplee" class="table table-hover">
                                  <thead>
                                      <tr>
                                        <th>Usurario</th>
                                        <th>Empresa</th>
                                        <th>Acción</th>
                                        <th>Fecha</th>
                                      </tr>
                                  </thead>
                                  <tbody style="background: white;">

                                      @foreach ($Historial as $History)
                                       <tr>
                                          <td>{{ $History->username}}</td>
                                          <td>{{ $History->company }}</td>
                                          <td>{{ $History->action }}</td>
                                          <td>{{ $History->date }}</td>
                                        </tr>
                                      @endforeach
                                  </tbody>
                                </table>
                          </div>
                            <div class="row clearfix">
                                  <div class="col-sm-10"></div>
                                  <div class="col-sm-2">
                                    <form action="{{ route('HistoryDeleteA') }}" id="fromhistory">
                                          @method('PUT')
                                          @csrf
                                          <center>
                                            <button type="submit" class="btn btn-danger waves-effect">
                                              <i class="material-icons">clear</i> <span>Borrar Historial</span> 
                                            </button>
                                          </center>
                                    </form>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>

<script type="text/javascript">
  $("#History").addClass('active');
</script>
<script type="text/javascript">
                $('#dtBasicExamplee').DataTable({
                    language: {
                        url: '{{ asset('json/Spanish.json')}}'
                    },
                    "paging":   true,
                    "ordering": true,
                    "searching": true,
                    "info":     false,
                    "responsive"    : true
                });
          
  
    </script>
@endsection