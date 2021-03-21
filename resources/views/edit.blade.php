@extends('layouts.master')


@section('content')
	<h4>Editar datos</h4>

<form method="POST" action="{{ route('tareas.update', $tarea->id) }}">
	<!-- Nuestro campo de proteccion de formulario -->
	{{ csrf_field() }}
	{{ method_field ('PUT') }}

	<!-- Campos del formulario -->
	<input type="text" name="name" placeholder="Nombre de tarea" value="{{ $tarea->name }}">
	<br><br>
	
	<label>Descripcion</label>
	<textarea name="description"> {{ $tarea->description }}</textarea>
	<br>
	<br>
	<br>
	<label>Fecha de entrega</label>
	<input type="date" name="due_date" value="{{ $tarea->due_date }}">

	<!-- Guardar Formulario -->
	<button type="submit">Guardar Tarea</button>
</form>

<button></button>
@endsection
