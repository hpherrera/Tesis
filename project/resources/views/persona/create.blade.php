@extends('layouts.app')

@section('content')
<section class="content-header">
	<h1>
		Usuario
		<small>Registrar</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="/"><i class="fa fa-home"></i> Home</a></li>
		<li class="active">Registrar</li>
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
			<h3 class="box-title">Registrar Usuario</h3>
		</div>
		<div class="panel-body">
            <form class="form-horizontal" method="POST" action="/persona">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    <label for="nombre" class="col-md-4 control-label">Nombre</label>

                    <div class="col-md-6">
                        <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>

                        @if ($errors->has('nombre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('apellidos') ? ' has-error' : '' }}">
                    <label for="apellidos" class="col-md-4 control-label">Apellidos</label>

                    <div class="col-md-6">
                        <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}" required autofocus>

                        @if ($errors->has('apellidos'))
                            <span class="help-block">
                                <strong>{{ $errors->first('apellidos') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('rol_id') ? 'has-error': '' }}">
					<label for="rol" class="col-md-4 control-label">Rol</label>
					<div class="col-md-6">
						<select class="form-control" name="rol_id" id="select-rol" ">
							@foreach($roles as $rol)
								<option value="{{ $rol->id }}">{{ $rol->nombre() }}</option>
							@endforeach
						</select>
						@if ($errors->has('rol_id'))
							<span class="help-block">
								<strong>{{ $errors->first('rol_id') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div id="matricula" class="form-group{{ $errors->has('matricula') ? ' has-error' : '' }}" hidden>
                    <label for="nombre" class="col-md-4 control-label">Matricula</label>

                    <div class="col-md-6">
                        <input id="matricula" type="text" class="form-control" name="matricula" value="{{ old('matricula') }}">

                        @if ($errors->has('matricula'))
                            <span class="help-block">
                                <strong>{{ $errors->first('matricula') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>	

                <div id="invitado" class="form-group{{ $errors->has('tipo_id') ? 'has-error': '' }}" hidden>
					<label for="tipo" class="col-md-4 control-label">Tipo</label>
					<div class="col-md-6">
						<select class="form-control" name="tipo_id" id="select-tipo-invitado" ">
							@foreach($tipos as $tipo)
								<option value="{{ $tipo->id }}">{{ $tipo->nombre() }}</option>
							@endforeach
						</select>
						@if ($errors->has('tipo_id'))
							<span class="help-block">
								<strong>{{ $errors->first('tipo_id') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div id="nombre_Empresa" class="form-group{{ $errors->has('empresa') ? ' has-error' : '' }}" hidden>
                    <label for="empresa" class="col-md-4 control-label">Empresa</label>

                    <div class="col-md-6">
                        <input id="empresa" type="text" class="form-control" name="empresa" value="{{ old('empresa') }}">

                        @if ($errors->has('empresa'))
                            <span class="help-block">
                                <strong>{{ $errors->first('empresa') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>	

                <div id="carrera" class="form-group{{ $errors->has('carrera') ? ' has-error' : '' }}" hidden>
                    <label for="carrera" class="col-md-4 control-label">Carrera</label>

                    <div class="col-md-6">
                        <input id="carrera" type="text" class="form-control" name="carrera" value="{{ old('carrera') }}">

                        @if ($errors->has('carrera'))
                            <span class="help-block">
                                <strong>{{ $errors->first('carrera') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>			

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-success pull-right">
                            Registrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
	</div>
</section>
@endsection

@section('script')

<script>
	$('#select-rol').on('change', function() {
    	var id = $(this).val();
    	if(id == 5)
    	{
    		$('#matricula').show();
    		$('#invitado').hide();
    		$('#carrera').hide();
    	}
    	else if(id == 6)
    	{
    		$('#invitado').show();
    		$('#carrera').show();
    		$('#matricula').hide();
    	}
    	else{

    		$('#matricula').hide();
    		$('#invitado').hide();
    	}
	});

	$('#select-tipo-invitado').on('change',function(){

		var id = $(this).val();
		if(id == 2){
			$('#nombre_Empresa').show();
			$('#carrera').hide();
		}
		else if( id == 1){
			$('#carrera').show();
			$('#nombre_Empresa').hide();

		}
		else
		{
			$('#nombre_Empresa').hide();
			$('#nombre_Empresa').hide();
		}
	});
</script>

@endsection
