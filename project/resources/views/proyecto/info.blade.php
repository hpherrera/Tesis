@extends('layouts.app')

@section('content')

<div class="container">
	<section class="content-header">
		<h1>
			{{$proyecto->titulo}}
			<small>información</small>
		</h1>
		<hr>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Todos</li>
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
				<h3 class="box-title">Todos los Hitos</h3>
			</div>
			<div class="box-body">
				<table id="table" class="table table-striped">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Fecha Inicio</th>
							<th>Fecha Termino</th>
							<th>Progreso %</th>
						</tr>
					</thead>
					<tbody>
						@foreach($hitos as $hito)
						<tr>
							<td><a href="/hito/{{ $hito->id }}/info" data-toggle="tooltip" title="ver información">{{ ucfirst($hito->nombre) }}</a></td>
							<td>{{ ucfirst($hito->fecha_inicio) }}
							<td>{{ ucfirst($hito->fecha_termino) }}</td>
							<td>0 %</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>
@endsection


@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}"/>
<style type="text/css">
  hr { 
    border: 1px solid #BDBDBD; 
    border-radius: 200px /8px; 
    height: 0px; 
    text-align: center; 
  } 

  .vl {
    border-left: 0.1px solid #BDBDBD;
    height: 600px;
  }
</style>
@endsection('style')

@section('script')

<script>
	function Eliminar(id){
		$('#form-delete').attr('action', '/hito/delete/'+id);
		$('#DeleteModal').modal('toggle');
	};
</script>

<script>
  $(function () {
      $('[data-toggle="tooltip"]').tooltip()
  })
</script>
<script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>	
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