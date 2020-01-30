@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SuperAdmin</title>
	<link rel="stylesheet" href="">
</head>
<body class="Body_SupAdmin">
	<div class="addBar">
	<section class='buttons'>
        <a href="{{url('/addUser/create')}}" class="ButtonAdd_SA btn">
            <div><i class="material-icons">person_add</i></div>
            <div>Añadir Usuario</div>
        </a>
    </section>
    <div class="Search">
        <input class="form-control" id="myInput" type="text" placeholder="Buscar...">
    </div>
	</div>

	<div class="TableDiv table-bordered wrapper_scroll Custome_scrollbar">
		<table class="table">
			<thead class="Table_header">
				<tr>
					<th>#</th>
				    <th>NOMBRE</th>
				    <th>USUARIO</th>
				    <th>TIPO</th>
				    <th>CORREO</th>
				    <th>VER</th>
				</tr>
			</thead>
		    <tbody class="Table_Body" id="TableCustom">
		    	@foreach ($Users as $user)
		    		<tr>
		    			<td>{{ $user->id }}</td>
			    		<td>{{ $user->firstName." ".$user->lastName }}</td>
			    		<td>{{ $user->username }}</td>
			    		@if ($user->role_id == 3)
			    			<td>Analista</td>
			    		@endif
			    		@if ($user->role_id == 4)
			    			<td>Comun</td>
			    		@endif
			    		<td>{{ $user->email }}</td>
			    		<td>
			    			<input type="button" class="btn btn-primary" name="" value="EDITAR" style="background-color: green;color: white;border:none;"
							onclick="window.location='{{ route('UpdateUsers',$user->id) }}'">
			    		</td>
		    		</tr>
		    	@endforeach
		    </tbody>
	    </table>
    </div>
</body>
</html>
@endsection
