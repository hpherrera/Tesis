@extends('layouts.app')

@section('content')
	<div class="container">
    <section class="content-header">
      <h1>
      @foreach($proyecto as $proyect)
        {{ ucfirst($proyect->titulo) }}
      @endforeach
      </h1>
      <hr>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Home</li>
      </ol>
    </section>


    <section class="content">
      <div class="row">

        <div class="col-md-8">
          <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Todos los Hitos</h3>
      </div>
      <div class="box-body">
        <table id="table" class="table table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Progreso %</th>
              <th class="no-sort"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($hitos as $hito)
            <tr>
              <td>{{ ucfirst($hito->nombre) }}</td>
              <td>0 %</td>
              <td>
              <div class="btn-group">
                <button type="button" class="btn btn-info btn-xs">Acciones</button>
                <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="/hito/{{ $hito->id }}/edit"><i class="fa fa-pencil"></i> Editar </a></li>
                  <li> <a onclick="Eliminar('{{ $hito->id }}')"><i class="fa fa-remove"></i>Eliminar</a></li>
                  <li><a href="/hito/{{ $hito->id }}/info"><i class="fa fa-eye"></i> ver </a></li>
                  <!--<li><a href="/tarea/create/{{ $hito->id }}"> <i class="fa fa-save"></i>Agregar Tarea</a></li>-->
                </ul>
              </div> 
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
        </div>

        <div class="col-md-4">
          <div class="vl col-md-1"></div>
          <div class="row">
            <h4 align="CENTER">CALENDARIO</h4>
              <div id="calendario" class="col-md-10"></div>
            <div class="col-md-10"><hr></div>
            <h4 align="CENTER">EVENTOS PROXIMOS</h4>
            <br>
            <div class="col-md-10"><i class="fa fa-tasks"></i><b> Tarea 2: Entrevista con el cliente para capturar requisitos</b></div>
            <div class="col-md-10"><i class="fa fa-calendar"></i> Lunes, 11 Diciembre</div>
            <br>
            <!--<div class="col-md-10"><a href="#"><span><b>Ir al Calendario </b></span></a></div>-->
            <div class="col-md-10"><hr></div>
            <h4 align="CENTER">ACTIVIDAD RECIENTE</h4>
            <br>
            <div class="col-md-10"><i class="fa fa-comment"></i><b> Comentario:</b> Tarea 2</div>
            <br>
            <div class="col-md-10"><i class="fa fa-comment"></i><b> Comentario:</b> Tarea 3</div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('modal')
<!-- Modal -->
<div class="modal fade" id="DeleteModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Eliminar Hito</h4>
      </div>
      <form id="form-delete" method="POST" role="form">
      {{ csrf_field() }}
      <div class="modal-body">
        <p> Desea eliminar el hito?</p>
        <p> Recuerde que al eliminar el hito se eliminaran las tareas y entregables asociadas a este.</p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger pull-left" >Si, eliminar</button>
        <button type="button" class="btn btn-default pull-rigth" data-dismiss="modal">No, Cancelar</button>
      </div>
      </form>
    </div>

  </div>
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
    height: 700px;
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

<script>
  $('#calendario').fullCalendar({
        height: 300,
        locale: 'es'
  });
</script>
@endsection
