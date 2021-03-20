@extends('layouts.master')


@section('content')
<div class="container-fluid">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">{{ $tarea->name }}</h5>
    <p class="card-text">
     
		<p> {{ $tarea->description }}</p>
		<p>Fecha de entrega: {{ $tarea->due_date}}</p>
		<p>Modalidad: {{$tarea->modality}}</p>
		<p>Condicion: {{$tarea->status}}</p>
    </p>
   <a href="{{ route('tareas.index') }}"> <button type="button" class="btn btn-primary">Regresar</button></a>
  </div>
</div>
</div>






@endsection