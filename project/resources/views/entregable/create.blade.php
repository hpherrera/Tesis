@extends('layouts.app')

@section('content')
<div class="container">
	<section class="content-header">
		<h1>
			Entregable
			<small>Para la tarea "<b>{{$tarea->nombre}}"</b></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Crear</li>
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
		
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Crear Entregable </h3>
			</div>
			<form method="POST" role="form" action="/entregable" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback {{ $errors->has('nombre') ? 'has-error': '' }}">
								<label>Nombre</label>
								<input type="text" class="form-control" placeholder="EJ: diagrama diseño..." name="nombre">
								@if ($errors->has('nombre'))
								<span class="help-block">
									<strong>{{ $errors->first('nombre') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group">
			                  	<label for="exampleInputFile">Archivo a subir (Formato PDF)</label>
			                  	<input type="file" id="archivo" name="archivo" required>

			                  	<p class="help-block">Seleccionar archivo</p>
							</div>
							<input type="hidden" name="tarea_id" value="{{ $tarea->id }}">
							<input type="hidden" name="hito" value="{{$tarea->hito->id}}">
						</div>
					</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-success btn-flat pull-right"><i class="fa fa-save"></i> Guardar </button>
				</div>
			</form>
		</div>
	</section>
</div>
@endsection
@section('script')
@endsection