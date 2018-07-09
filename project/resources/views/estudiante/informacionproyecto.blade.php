@extends('layouts.app')

@section('content')
<section class="content-header">
	<h1>
		Información
	</h1>
	<ol class="breadcrumb">
		<li><a href="/"><i class="fa fa-home"></i> Home</a></li>
		<li class="active">Home</li>
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
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">{{$proyecto->titulo}}</h3>
				</div>
				<div class="box-body">
					<blockquote>
	                	<p>{{$estudiante->nombres}} {{$estudiante->apellidos}}</p>
	                	<small><cite title="Source Title">Estudiante</cite></small>
	              	</blockquote>
	              	<blockquote>
	                	<p>{{$estudiante->email }}</p>
	                	<small><cite title="Source Title">Email</cite></small>
	              	</blockquote>
	              	<blockquote>
	                	<p>{{$proyecto->tipo->tipo}}</p>
	                	<small><cite title="Source Title">Tipo</cite></small>
	              	</blockquote>
	              	<blockquote>
	                	<p>
	                	@if($proyecto->semestre == 1)
	                		Primer
	                	@else
	                		Segundo
	                	@endif
	                	</p>
	                	<small><cite title="Source Title">Semestre Egreso</cite></small>
	              	</blockquote>
	              	<blockquote>
	                	<p>{{$proyecto->year}}</p>
	                	<small><cite title="Source Title">Año Egreso</cite></small>
	              	</blockquote>
	              	<blockquote>
	                	<p>{{$documentofinal->nombre}} <a href="/entregable/{{ $documentofinal->id }}/Descargar"><i class="fa fa-file-pdf-o" data-toggle="tooltip" title="Descargar" ></i></a> </p>
	                	<small><cite title="Source Title">Año Egreso</cite></small>
	              	</blockquote>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection


@section('style')
@endsection('style')
@section('script')
@endsection
