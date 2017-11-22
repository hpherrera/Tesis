@extends('layouts.app')

@section('content')
<div class="container">
	<section class="content-header">
		<h1>
			Proyecto
			<small>Editar</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Editar</li>
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

		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title">Editar Proyecto</h3>
			</div>
			<form method="POST" role="form" action="/proyecto/update/{{ $proyecto->id }}">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group has-feedback {{ $errors->has('titulo') ? 'has-error': '' }}">
								<label>Título</label>
								<input type="text" class="form-control" name="titulo" value="{{ $proyecto->titulo }}">
								@if ($errors->has('titulo'))
								<span class="help-block">
									<strong>{{ $errors->first('titulo') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('estudiante_id') ? 'has-error': '' }}">
								<label>Estudiante</label>
								<select class="form-control" name="estudiante_id">
									@foreach($estudiantes as $estudiante)
									<option value="{{ $estudiante->id }}">{{ $estudiante->nombre() }}</option>
									@endforeach
								</select>
								@if ($errors->has('estudiante_id'))
								<span class="help-block">
									<strong>{{ $errors->first('estudiante_id') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('tipo_id') ? 'has-error': '' }}">
								<label>Tipo</label>
								<select class="form-control" name="tipo_id">
									@foreach($tipos as $tipo)
										@if($tipo->id == $proyecto->tipo_id)
											<option value="{{ $tipo->id }}" selected="">{{ $tipo->nombre() }}</option>
										@else
											<option value="{{ $tipo->id }}">{{ $tipo->nombre() }}</option>
										@endif
									@endforeach
								</select>
								@if ($errors->has('tipo_id'))
								<span class="help-block">
									<strong>{{ $errors->first('tipo_id') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('estado_id') ? 'has-error': '' }}">
								<label>Estado</label>
								<select class="form-control" name="estado_id">
									@foreach($estados as $estado)
										@if($estado->id == $proyecto->estado_id)
											<option value="{{ $estado->id }}" selected="">{{ $estado->nombre() }}</option>
										@else
											<option value="{{ $estado->id }}">{{ $estado->nombre() }}</option>
										@endif
									@endforeach
								</select>
								@if ($errors->has('estado_id'))
								<span class="help-block">
									<strong>{{ $errors->first('estado_id') }}</strong>
								</span>
								@endif
							</div>
							<div class="form-group has-feedback {{ $errors->has('area_id') ? 'has-error': '' }}">
								<label>Area</label>
								<select class="form-control" name="area_id">
									@foreach($areas as $area)
										@if($area->id == $proyecto->area_id)
											<option value="{{ $area->id }}" selected="">{{ $area->nombre() }}</option>
										@else
											<option value="{{ $area->id }}">{{ $area->nombre() }}</option>
										@endif
									@endforeach
								</select>
								@if ($errors->has('area_id'))
								<span class="help-block">
									<strong>{{ $errors->first('area_id') }}</strong>
								</span>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<a href="/" class="btn btn-default btn-flat">Volver</a>
					<button type="submit" class="btn btn-warning btn-flat pull-right">Editar Proyecto</button>
				</div>
			</form>
		</div>
	</section>
</div>
@endsection