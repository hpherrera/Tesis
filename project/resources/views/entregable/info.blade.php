@extends('layouts.app')

@section('content')

<div class="container">
	<section class="content-header">
		<h1>
			{{$EntregablePadre->nombre}}
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-home"></i>Entregable</a></li>
			<li class="active"></li>
		</ol>
	</section>

	<section class="content">
		@if(session('message'))
		<div class="alert alert-{{ session('type') }} alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa {{ session('icon') }}"></i> {{ session('title') }}</h4>
			{{ session('message') }}
		</div>
		@endif
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Datos del entregable</h3>
			</div>
			<div class="box-body">
				<table id="table" class="table table-striped">
					<thead>
						<tr>
							<th>Archivo</th>
							<th>Nombre</th>
							<th>Fecha Envío</th>
							<th>Revisión</th>
							<th>Fecha Revisión</th>
							<th>Subido por</th>
							<th class="no-sort"></th>
						</tr>
					</thead>
					<tbody>
					@foreach($entregables as $entregable)
					<tr>
						<td><a href="/entregable/{{ $entregable->id }}/Descargar"><i class="fa fa-file-pdf-o" data-toggle="tooltip" title="Descargar" ></i></a>
						</td>
						<td>{{$entregable->nombre()}}</td>
						<td>{{$entregable->fecha}}</td>
						<td>En revisión</td>
						<td>{{$entregable->fecha}}</td>
						<td> profesor o alumno<td>
						<td><a href="/entregable/{{ $entregable->id }}/Descargar" class="btn btn-info btn-sm pull-right"><i class="fa fa-cloud-download"></i> Descargar</a></td>
					</ tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<!-- Revision -->
		@if(Auth::user()->rol_id == 3)
		<div>
			<button type="button" onclick="subirRevision()" class="btn btn-primary fa fa-upload"> Subir Revisión</button>
		</div>
		@endif

		@if(Auth::user()->rol_id == 5)
		<div>
			<button type="button" onclick="subirRevision()" class="btn btn-primary fa fa-upload"> Subir Modificación</button>	
		</div>
		@endif

		<!-- Comentarios -->
		<div >
			<h4>Comentarios</h4>
		</div>
		<ul class="timeline">
            <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                <h3 class="timeline-header"><a href="#">Yo</a></h3>

                <div class="timeline-body">
                  Tengo dudas si en el documento de requisitos va o no el diseño
                </div>
              </div>
            </li>
  		</ul>
	</section>
</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="RevisionModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Revisión</h4>
      </div>
      <form  method="POST" role="form" action="/entregableRevision" enctype="multipart/form-data">
			{{ csrf_field() }}
      <div class="modal-body">
      	<label>Nombre</label>
		<input type="text" class="form-control" placeholder="EJ: diagrama diseño..." name="nombre">
		@if ($errors->has('nombre'))
		<span class="help-block">
			<strong>{{ $errors->first('nombre') }}</strong>
		</span>
		@endif

		<div class="form-group">
          	<label for="exampleInputFile">Archivo a subir (Formato PDF)</label>
          	<input type="file" id="archivo" name="archivo" required>

          	<p class="help-block">Seleccionar archivo</p>
		</div>

		<label>Comentario</label>
		<textarea class="form-control" rows="3" placeholder="Comentario..." name="comentario"></textarea>
		@if ($errors->has('nombre'))
		<span class="help-block">
			<strong>{{ $errors->first('nombre') }}</strong>
		</span>
		@endif

        <input type="hidden" name="entregablePadre" value="{{$EntregablePadre->id}}">
        <input type="hidden" name="tarea" value="{{$EntregablePadre->tarea_id}}">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success pull-left fa fa-upload"> Subir</button>
        <button type="button" class="btn btn-default pull-rigth" data-dismiss="modal">No, Cancelar</button>
      </div>
      </form>
    </div>

  </div>
</div>
@endsection


@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}"/>
@endsection('style')

@section('script')

<script>
  function subirRevision(){
    $('#RevisionModal').modal('toggle');
  };
</script>

<script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>	
<script>
  $(function () {
      $('[data-toggle="tooltip"]').tooltip()
  })
</script>

<script>
	var table;

	$(document).ready(function () {
		table = $("#table").DataTable({
			"responsive": true,
			"order": [0, 'asc'],
			"paging": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"columnDefs": [
			{ targets: 'no-sort', orderable: false }
			], 
			"language": {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				}, 
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			},
		});
	});
</script>
@endsection