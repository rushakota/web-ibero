@extends('layouts.master')

@section('content')
<div class="container-fluid ">
	<div class="row">
		<div class="col-md-8">
			<div class="title-page py-4 px-5">
		<h3 class="display-1"> Bienvenido Usuario</h3>
		<p class="lead ">Esta es una aplicacion de tareas, utilizala todos los dias</p>
		</div>
		</div>
		<div class="col-md-4  py-5 px-8">
			<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CreateModal">
  				Crear nueva Tarea
				</button>
		</div>
	</div>
	
	<div class="row">
		

		<div class="col-md-9	 py-4 px-5">

			<div class="card">
				<h5 class="card-header">Listado de Tareas</h5>
				<div class="card-body">
					<h5 class="card-title">Tareas Pendientes</h5>
					<p class="card-text">Este es tu listado principal de tareas, ponte a trabajar</p>
					<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tarea</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Fecha de entrega</th>
      <th scope="col">Modalidad</th>
      <th scope="col">Condición</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($tareas as $tarea)
    <tr>
      <th scope="row">{{$tarea->id}}</th>
      <td>{{$tarea->name}}</td>
      <td>{{$tarea->description}}</td>
      <td>{{$tarea->due_date}}</td>
      <td>{{$tarea->modality}}</td>
      <td>@if ($tarea->status == 'Incompleto')
      			<div class="btn-danger">Incompleto</div>
      		@endif
      		@if ($tarea->status == 'Completa')
      			<div class="btn-success">Completa</div>
      		@endif</td>
      <td><div class="col-md-12"> <a href="{{route('tareas.show', $tarea->id) }}"><button type="button" class="btn btn-info">Ver detalles</button></a>
      	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditModal_{{ $tarea->id }}"> Editar Tarea </button>
      	<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal_{{ $tarea->id }}"> Borrar Tarea </button>
      	<a href="{{ route('tareas.edit', $tarea->id) }}"><button type="button" class="btn btn-success" data-bs-toggle="modal"  > Cambiar status </button></a>
				</td>
				</div>
    </tr>


    <!-- Edit Modal -->
<div class="modal fade" id="EditModal_{{ $tarea->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar tarea</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

     													 <div class="modal-body">
													 		<div class="container-fluid">
																<form method="POST" action="{{ route('tareas.update', $tarea->id) }}">
															<!-- Nuestro campo de proteccion de formulario -->
															{{ csrf_field() }}
															{{ method_field ('PUT') }}

															<!-- Campos del formulario -->
															<div class="form-group">
																<label>Nombre de tarea</label>
																<input class="form-control" type="text" name="name" placeholder="Nombre de tarea" value="{{ $tarea->name }}">

															</div>
															
															<div class="form-group">
																<label>Descripcion</label>
															<textarea class="form-control" name="description"> {{ $tarea->description }}</textarea>
															</div>
															
																<div class="form-group">
																		<label>Modalidad</label>
																		<select class="form-control" name="modality">
																			<option value="Individual">Individual</option>
																			<option value="Individual">Por equipo</option>
																			<option value="Individual">Ayuda exterior</option>
																		</select>
															</div>

															<div class="form-group">
																		<label>Fecha de entrega</label>
																		<input class="form-control" type="date" name="due_date" value="{{ $tarea->due_date }}">
															</div>


														</div>
													      </div>

															<!-- Guardar Formulario -->
															 <div class="modal-footer">
       														 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
															<button class="btn btn-success" type="submit">Guardar Tarea</button>
														</form>
													</div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="DeleteModal_{{ $tarea->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Estas Seguro?</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
       <form method="POST" action="{{route ('tareas.destroy', $tarea->id) }}">
		{{ csrf_field() }}
		{{method_field ('DELETE') }}
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
       

<button type="submit" class="btn btn-primary">Si estoy seguro</button>
</form>
        
      </div>
    </div>
  </div>
</div>
    @endforeach
  
  </tbody>
</table>
</div>
</div>
			
			
			


		</div>
	</div>	
</div>
	
<!-- Modal -->
<div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear nueva tarea</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
													      <div class="modal-body">
													 		<div class="container-fluid">
																<form method="POST" action="{{ route('tareas.store') }}">
															<!-- Nuestro campo de proteccion de formulario -->
															{{ csrf_field() }}

															<!-- Campos del formulario -->
															<div class="form-group">
																<label>Nombre de tarea</label>
																<input class="form-control" type="text" name="name" placeholder="Nombre de tarea">

															</div>
															
															<div class="form-group">
																<label>Descripcion</label>
															<textarea class="form-control" name="description"></textarea>
															</div>

															<div class="form-group">
																		<label>Modalidad</label>
																		<select class="form-control" name="modality">
																			<option value="Individual">Individual</option>
																			<option value="Individual">Por equipo</option>
																			<option value="Individual">Ayuda exterior</option>
																		</select>
															</div>
															
															<div class="form-group">
																		<label>Fecha de entrega</label>
																		<input class="form-control" type="date" name="due_date">
															</div>

														</div>
													      </div>

															<!-- Guardar Formulario -->
															 <div class="modal-footer">
       														 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
															<button class="btn btn-success" type="submit">Guardar Tarea</button>
														</form>
													</div>
														     
        
      </div>
    </div>
  </div>
</div>



	

	
	
@endsection