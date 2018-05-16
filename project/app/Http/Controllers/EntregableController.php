<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Hito;
use App\Estudiante;
use App\User;
use App\Proyecto;
use App\Tarea;
use App\Entregable;
use App\Documento;
use App\Notificacion;
use App\Persona;
use Storage;
use File;
use App\Mail\NotificacionTarea;

class EntregableController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $proyecto = Proyecto::where('estudiante_id',"=",auth()->user()->id)->get();
        $hitos = Hito::where('proyecto_id',"=",$proyecto[0]['id'])->get();
        $tareas = array();
        $tareas_todas = Tarea::all();
        foreach ($tareas_todas as $tarea) {
            foreach ($hitos as $hito) {
                if($tarea->hito_id == $hito->id)
                {
                    array_push($tareas,$tarea); 
                }
            }
           
        }

        $entregables_proyecto = Entregable::all();
        $entregables = array();
        foreach ($tareas as $tarea) {
            foreach ($entregables_proyecto as $entregable) {
                if($entregable->tarea_id == $tarea->id)
                {
                    array_push($entregables,$entregable);
                }
            }
        }

        return view('entregable.index',compact('entregables'));
    }

    public function create(Tarea $tarea)
    {
        return view('entregable.create',compact('tarea'));
    }

    public function create2()
    {
        $proyecto = Proyecto::where('estudiante_id',"=",auth()->user()->id)->get();
        $hitos = Hito::where('proyecto_id',"=",$proyecto[0]['id'])->get();
        $tareas = array();
        $tareas_todas = Tarea::all();
        foreach ($tareas_todas as $tarea) {
            foreach ($hitos as $hito) {
                if($tarea->hito_id == $hito->id)
                {
                    array_push($tareas,$tarea); 
                }
            }
           
        }
        return view('entregable.create2',compact('tareas'));
    }

    public function store(Request $request)
    {

        /* obtengo el archivo PDF */
        $file = $request->file('archivo');

        /* Asigno un nombre unico al archivo Pdf */
        $uniqueFileName = uniqid() . $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();

        if($file->getClientOriginalExtension() != 'pdf')
        {
            //Mensaje
            session()->flash('title', '¡Error!');
            session()->flash('message', 'El documento no es del formato solicitado!');
            session()->flash('icon', 'fa-remove');
            session()->flash('type', 'danger');
            return redirect('entregable/create2');
        }
        else
        {
            /* Creo  la Carpeta en orden de hito a tarea /ID_HITO/ID_TAREA y guardo en servidor */
            $carpeta = $request->hito."/".$request->tarea_id;
            $file->move(storage_path('archivos/'.$carpeta) , $uniqueFileName);


            /* Creo el entregable para enviarlo a base de datos */
            $carbon = new Carbon();
            $entregable = Entregable::create([
                'nombre' => $request['nombre'],
                'fecha' => $carbon->now(),
                'tarea_id' => $request['tarea_id'] ,
                'estadoEntregable_id' => 5,
                'ruta' => $carpeta."/".$uniqueFileName
            ]);

            //Mensaje
            session()->flash('title', '¡Éxito!');
            session()->flash('message', 'El documento se a subido exitosamente!');
            session()->flash('icon', 'fa-check');
            session()->flash('type', 'success');

            /* Buscar Profesor Guia para obtener su eamil */
            $proyecto = Proyecto::where('estudiante_id',"=",auth()->user()->id)->get();
            $profesorGuia = User::find($proyecto[0]['profesorGuia_id']);
            $emailProfesorGuia = $profesorGuia->email;

            /* email Estudiante */
            $eamilEstudiante = auth()->user()->email;

            /* Crear Notificacion */
            $estudiante = Persona::find(auth()->user()->id);
            $tarea = Tarea::find($request->tarea_id);
            Notificacion::create([
                'texto' => 'El estudiante '.$estudiante->nombre().' subio un entregable en la tarea '.$tarea->nombre,
                'tipo_notificacion_id' => 0,
                'leido' => 0,
                'email' => $emailProfesorGuia
            ]);

            /* Crear mensaje y enviar notificacion */
            Mail::to($emailProfesorGuia)->send(new NotificacionTarea($entregable));

            return redirect()->action(
                    'TareaController@info', ['tarea' => $request->tarea_id]
            );
        }

        
    }

    public function edit(Entregable $entregable)
    {
        $proyecto = Proyecto::where('estudiante_id',"=",auth()->user()->id)->get();
        $hitos = Hito::where('proyecto_id',"=",$proyecto[0]['id'])->get();
        $tareas = array();
        $tareas_todas = Tarea::all();
        foreach ($tareas_todas as $tarea) {
            foreach ($hitos as $hito) {
                if($tarea->hito_id == $hito->id)
                {
                    array_push($tareas,$tarea); 
                }
            }
           
        }
        return view('entregable.edit', compact('tareas','entregable'));
    }
    
    public function update(Request $request, $id)
    {
        ///dd($request);
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|min:3|max:100',
        ]);

        if ($validator->fails()) 
        {
            session()->flash('title', '¡Error!');
            session()->flash('message', 'Existieron errores!');
            session()->flash('icon', 'fa-check');
            session()->flash('type', 'danger');
            return redirect('entregable/create')->withErrors($validator)->withInput();
        }

        $carbon = new Carbon();
       
        $entregable = Entregable::find($id);
        $entregable->nombre = $request['nombre'] ;
        $entregable->fecha = $carbon->now();
        $entregable->tarea_id = $request['tarea_id'] ;
        $entregable->save();

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El entregable se ha editado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');
        
        return redirect()->action(
                'TareaController@info', ['tarea' => $request->tarea_id]
        );     
    } 

    public function info(Entregable $entregable)
    {
        return view('entregable.info',compact('entregable'));
    }

    public function delete(Entregable $entregable)
    {
        //dd($entregable);
        $entregable_nombre = $entregable->nombre;
        $entregable->delete();

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El entregable '. $entregable_nombre.' se ha eliminado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('/indexEntregable'); 
    }

    public function descargar($id){

         $entregable = Entregable::find($id);
         $rutaarchivo= "../storage/archivos/".$entregable->ruta;
         return response()->download($rutaarchivo);
    }
}
