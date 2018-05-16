@component('mail::message')

# Notificación de entrega

Se ha subido un nuevo entregable al sistema a las {{ $entregable->fecha }}.

@component('mail::panel')
### Datos del entregable:

- **Entregable:** {{ $entregable->nombre() }}
- **Alumno:** {{ $entregable->tarea->hito->proyecto->persona->nombre() }}
- **Tarea:** {{ $entregable->tarea->nombre() }}
@endcomponent

Gracias,<br>
Sistema de gestión y control documental de proyectos de título.<br><br>

@endcomponent

