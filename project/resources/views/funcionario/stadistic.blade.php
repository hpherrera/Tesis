@extends('layouts.app')

@section('content')
<section class="content-header">
	<h1>
		Estadisticas
		<small>Estudiantes Activos</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="/"><i class="fa fa-home"></i> Home</a></li>
		<li class="active">Todos</li>
	</ol>
</section>

<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Filtros</h3>
		</div>
		<form role="form" action="#">
			{{ csrf_field() }}
			<div class="box-body">
				<div class="col-md-3">
					<label> Módulo </label>
					<select class="form-control" name="modulo">
						<option value="" disabled selected hidden style="color: gray">Seleccione Módulo...
						<option value="1">Formulación</option>
						<option value="2">Proyecto</option>
						<option value="3">Ambas</option>
					</select>
				</div>
				<div class="col-md-3">
					<label> Tipo </label>
					<select class="form-control" name="estado">
						<option value="" disabled selected hidden style="color: gray">Seleccione Estado...
						<option value="1">Vigente</option>
						<option value="2">Postergado</option>
						<option value="3">Eliminado</option>
						<option value="3">Todos</option>
					</select>
				</div>
				<!-- Cargar las fechas de base de datos -->
				<div class="col-md-3">
					<label> Año </label>
					<select class="form-control" name="anio">
						<option value="" disabled selected hidden style="color: gray">Seleccione Año...
						<option value="1">2018</option>
						<option value="2">2017</option>
						<option value="3">Todos</option>
					</select>
				</div>
				<div class="col-md-3">
					<label> Semestre </label>
					<select class="form-control" name="semestre">
						<option value="" disabled selected hidden style="color: gray">Seleccione Semestre...
						<option value="1">Primero</option>
						<option value="2">Segundo</option>
						<option value="3">Ambos</option>
					</select>
				</div>
			</div>
		</form>

		<!-- Panel del gráfico -->
		<div>
			
		</div>
	</div>
</section>

@endsection


@section('style')
@endsection('style')

@section('script')
@endsection

