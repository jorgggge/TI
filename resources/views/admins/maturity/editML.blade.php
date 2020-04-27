@extends('layouts.app')

@section('content')
<div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;">
                            <h2 style="color: white;">
                                 Niveles de madurez
                            </h2>
                            <ul class="header-dropdown m-r--5">
                              
                            </ul>
                        </div>
                        <div class="body">
                          <h2 class="card-inside-title"> Aqui podras editar los nombres de los niveles de madurez.
                                <br> (*) Datos Obligatorios.</h2>
                          <form id="from" method="POST"  action="{{ route('UpdateMaturity')}}">
                        @method('PUT')
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
                                            <input type="text" name="maturityName[{{ $M->maturityLevelId }}]" id="{{$count}}" class="form-control" placeholder="Usuario" required value="{{ $M->description}}">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        @php($count++)
                        @endforeach     
                        <div class="row clearfix">
                                <h2 class="card-inside-title"></h2>
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-5">
                                     <button class="btn btn-info" type="submit">Guardar</button>
                                </div>
                            </div>
                              </form>

                          </div> 
                         </div>
                      </div>		 
                    </div>
                  </div>
                </div>
              </div>

<script type="text/javascript">
  
$("#NivelesdeMadurez").addClass('active');

</script>
@endsection