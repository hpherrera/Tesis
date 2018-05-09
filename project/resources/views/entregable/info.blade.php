@extends('layouts.app')

@section('content')

<div class="container">
	<section class="content-header">
		<h1>
			{{$entregable->nombre}}
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
							<th>Fecha Envío</th>
							<th>Revisión</th>
							<th>Fecha Revisión</th>
						</tr>
					</thead>
					<tbody>
						<td><i class="fa fa-file-word-o" data-toggle="tooltip" title="Descargar" ></i></td>
						<td>{{$entregable->fecha}}</td>
						<td>En revisión</td>
						<td>En revisión</td>
					</tbody>
				</table>
			</div>
		</div>

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


@section('style')
<link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}"/>
@endsection('style')

@section('script')

<script src="{{ asset('plugins/datatables/datatables.min.js') }}"></script>	
<script>
  $(function () {
      $('[data-toggle="tooltip"]').tooltip()
  })
</script>
@endsection