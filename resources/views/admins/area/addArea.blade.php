@extends('layouts.app')

@section('content')


<div class="container-fluid">
            <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header" style="background-color: #112d4e;color: white;font-size: 24px;">
                           <i class="material-icons" style="font-size: 24px;">warning</i>
                            Alerta
                        </div>
                        <div class="body">
                                <div class="alert alert-danger" >
                                    {{ 'Agrega un área para empezar a trabajar.' }}
                                </div>                            
                        </div>
                    </div>
            </div>
</div>
@endsection
