@extends('layouts.app')

@section('content')
<section class="content-header">
	<h1>
		Usuario
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
			<h3 class="box-title">Editar Usuario</h3>
		</div>
		<div class="panel-body">
            <form class="form-horizontal" method="POST" action="/persona/update/{{ $persona->email }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    <label for="nombre" class="col-md-4 control-label">Nombre</label>

                    <div class="col-md-6">
                        <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $persona->nombres }}" required >

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
                        <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ $persona->apellidos}}" required>

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
                        <input id="email" type="email" class="form-control" name="email" value="{{ $persona->email}}" required>
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
						<select class="form-control" name="rol_id[]" id="select-rol" multiple required>
							@foreach($roles as $rol)
                                @if($persona->user->roles->contains('id', $rol->id))
								<option value="{{ $rol->id }}" selected >{{ $rol->nombre() }}</option>
                                @else
                                <option value="{{ $rol->id }}">{{ $rol->nombre() }}</option>
                                @endif
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
                        @if($persona->user['rol_id']  == 5)
                        <input id="matricula" type="text" class="form-control" name="matricula" value="{{ $matricula }}">
                        @else
                        <input id="matricula" type="text" class="form-control" name="matricula">
                        @endif
                        @if ($errors->has('matricula'))
                            <span class="help-block">
                                <strong>{{ $errors->first('matricula') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>	

                <div id="curso" class="form-group{{ $errors->has('curso_id') ? 'has-error': '' }}" hidden>
                    <label for="curso" class="col-md-4 control-label">Curso</label>
                    <div class="col-md-6">
                    @if($persona->user['rol_id']  == 4)
                        <select class="form-control" name="curso_id" id="select-curso" ">
                            @foreach($cursos as $curso)
                                @if($curso_id->id == $curso->id)
                                     <option value="{{ $curso->id }}" selected="">{{ $curso->nombre }}</option>
                                @else
                                     <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                                @endif 
                               
                            @endforeach
                        </select>
                        @if ($errors->has('curso_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('curso_id') }}</strong>
                            </span>
                        @endif
                    @endif
                    </div>
                </div>

                <div id="invitado" class="form-group{{ $errors->has('tipo_id') ? 'has-error': '' }}" hidden>
					<label for="tipo" class="col-md-4 control-label">Tipo</label>
					<div class="col-md-6">
                        @if($rol->nombre() == "Invitado")
						<select class="form-control" name="tipo_id" id="select-tipo-invitado" ">
							@foreach($tipos as $tipo)
                                @if($tipoInvitado ==  $tipo->id && $tipoInvitado != -1) 
                                    <option value="{{ $tipo->id }}" selected>{{ $tipo->nombre() }}</option>
                                @else
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombre() }}</option>
                                @endif
								
							@endforeach
						</select>
                        @else
                        <select class="form-control" name="tipo_id" id="select-tipo-invitado" ">
                            @foreach($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre() }}</option>
                            @endforeach
                        </select>
                        @endif
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
                    @if($tipoInvitado ==  2 )
                        <input id="empresa" type="text" class="form-control" name="empresa" value="{{ $nombreInvitado }}">
                    @else
                        <input id="empresa" type="text" class="form-control" name="empresa">
                    @endif
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
                        @if($tipoInvitado ==  1)
                        <input id="carrera" type="text" class="form-control" name="carrera" value="{{ $nombreInvitado }}">
                        @else
                        <input id="carrera" type="text" class="form-control" name="carrera">
                        @endif
                         @if ($errors->has('carrera'))
                            <span class="help-block">
                                <strong>{{ $errors->first('carrera') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>			

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-warning pull-right">
                            Editar
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
    @if($persona->user['rol_id'] == 5)
    {
        console.log("sii");
        $("#matricula .form-control").attr('required','required');
        $('#matricula').show();
    }
    @endif

    @if($persona->user['rol_id'] == 6)
    {
        console.log("sii");
        $('#invitado').show();
        //$('#carrera').show();
    }
    @endif

    @if($tipoInvitado == 2)
    {
        $("#nombre_Empresa .form-control").attr('required','required');
        $('#nombre_Empresa').show();
    }
    @endif

    @if($tipoInvitado == 1)
    {
        $("#carrera .form-control").attr('required','required');
        $('#carrera').show();
    }
    @endif

    @if($persona->user['rol_id'] == 4)
    {
        $('#curso').show();
    }
    @endif


	$('#select-rol').on('change', function() {
    	var id = $(this).val();
    	if(id == 4)
        {
            $('#curso').show();
            $('#invitado').hide();
            $('#carrera').hide();
            $('#matricula').hide();
        }
        else if(id == 5)
        {
            $("#invitado .form-control").removeAttr('required');
            $("#carrera .form-control").removeAttr('required');
            $("#matricula .form-control").attr('required','required');
            $('#matricula').show();
            $('#invitado').hide();
            $('#carrera').hide();
            $('#curso').hide();
        }
        else if(id == 6)
        {
            $("#invitado .form-control").attr('required','required');
            $("#carrera .form-control").attr('required','required');
            $('#invitado').show();
            $('#carrera').show();
            $("#matricula .form-control").removeAttr('required');
            $('#matricula').hide();
            $('#curso').hide();
        }
        else{
            
            $("#matricula .form-control").removeAttr('required');
            $("#invitado .form-control").removeAttr('required');
            $("#carrera .form-control").removeAttr('required');
            $('#matricula').hide();
            $('#invitado').hide();
            $('#carrera').hide();
            $('#curso').hide();
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
            $("#nombre_Empresa .form-control").removeAttr('required');
			$('#nombre_Empresa').hide();

		}
		else
		{
            $("#nombre_Empresa .form-control").removeAttr('required');
			$('#nombre_Empresa').hide();
			$('#carrera').hide();
		}
	});
</script>

<script>
    $(document).ready(function(){
        $('#select-rol').select2();
    });
</script>
@endsection

