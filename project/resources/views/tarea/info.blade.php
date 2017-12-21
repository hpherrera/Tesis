@extends('layouts.app')

@section('content')
	<div class="container">
    <section class="content-header">
      <h1><b>{{$tarea->nombre}}</b></h1>
      <hr>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Tarea/{{$tarea->id}}</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Entregables de la Tarea</h3>
              <a href="/entregable/{{ $tarea->id }}/create" data-toggle="tooltip" title="Agregar Entregable"class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i></a>
            </div>
            <div class="box-body">
              <table id="table" class="table table-striped">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Fecha Entrega</th>
                    <th>Estado</th>
                    <th class="no-sort"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($entregables as $entregable)
                    <tr>
                      <td> <a href="/entregable/{{ $entregable->id }}/info" data-toggle="tooltip" title="ver información"> {{ucfirst($entregable->nombre)}} </a></td>
                      <td>{{ ucfirst($entregable->fecha)  }}</td>
                      <td>{{ $entregable->estado->nombre  }}</td>
                      <td>
                      <a href="/entregable/{{ $entregable->id }}/edit" data-toggle="tooltip" title="Editar" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                      <a onclick="Eliminar('{{ $entregable->id }}')" data-toggle="tooltip" title="Eliminar" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
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
            <h4 align="CENTER">EVENTOS PROXIMOS</h4>
            <br>
            <div><i class="fa fa-tasks"></i><b> Tarea 2: Entrevista con el cliente para capturar requisitos</b></div>
            <div><i class="fa fa-calendar"></i> Lunes, 11 Diciembre</div>
            <br>
            <a href="#"><span><b>Ir al Calendario </b></span></a>
            <hr>

            <div>
              <h4 align="CENTER">ACTIVIDAD RECIENTE</h4>
              <br>
              <div><i class="fa fa-comment"></i><b> Comentario:</b> Tarea 2</div>
              <br>
              <div><i class="fa fa-comment"></i><b>Comentario:</b> Tarea 3</div>
            </div>
            
          </div>
        </div>
      </div>
    </section>
  </div>
@section('modal')
<!-- Modal -->
<div class="modal fade" id="DeleteModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Eliminar Entregable</h4>
      </div>
      <form id="form-delete" method="POST" role="form">
      {{ csrf_field() }}
      <div class="modal-body">
        <p> Desea eliminar el entregable?</p>
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
@endsection

@section('style')
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

<link rel="stylesheet" href="{{ asset('plugins/datatables/datatables.min.css') }}"/>
@endsection

@section('script')

<script>
  function Eliminar(id){
    $('#form-delete').attr('action', '/entregable/delete/'+id);
    $('#DeleteModal').modal('toggle');
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