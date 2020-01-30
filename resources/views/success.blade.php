@extends('layouts.app')

@section('content')

¡Registrado Exitosamente!
{{$user->username}}!


<a href="/register">
    <h4>Registrar Nuevo Usuario</h4>
</a>
@endsection
