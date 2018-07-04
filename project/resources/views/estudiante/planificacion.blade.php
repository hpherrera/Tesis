@extends('layouts.app')
 
@section('content')
<section class="content-header">
    <h1>
        Planificación
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Home</li>
    </ol>
</section>
<section class="content">
<div class="row">
        <div class="col-md-12">
            Fecha Limite Hito: <span><small class="label" style="background: #FFFF00; color: black">amarillo</small></span>
            
        </div>
        <div class="col-md-12">
            Fecha Limite Tarea: <span><small class="label" style="background: #04B404">verde</small></span>
            
        </div>
        <div class="col-md-12">
            Reunión Profesor : <span><small class="label" style="background: #FF3346">Rojo</small></span>
            
        </div>
</div>
    <div class="row">
        <div class="col-md-12">
            <div id='calendar'></div>
        </div>
    </div>
</section>

@endsection
@section('script')
<script>
 
    $(document).ready(function() { 
        $('#calendar').fullCalendar({
            eventRender: function(eventObj, $el) {
                $el.popover({
                    title: eventObj.title,
                    content: eventObj.description,
                    trigger: 'hover',
                    placement: 'top',
                    container: 'body'
                });
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicDay'
            },
            allDayText: false,
            allDaySlot: false,
            defaultTimedEventDuration: '01:00:00',
            slotLabelFormat: 'h(:mm)a',
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: {
                url: '/proyecto/hitos',
                type: 'POST',
                data:{
                    "_token": "{{ csrf_token() }}"
                },
                error: function() {
                    alert('Error al cargar las fechas');
                }
            }
        });
       
    });
 
</script>
 
@endsection
 
@section('style')
<style>
 
    body {
        margin: 0 0;
        padding: 0;
        font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
        font-size: 14px;
    }
 
    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }

    .fc-time{
        display : none;
    }
 
</style>
@endsection('style')