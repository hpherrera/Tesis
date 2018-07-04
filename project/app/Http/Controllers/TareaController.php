<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Hito;
use App\Estudiante;
use App\User;
use App\Proyecto;
use App\Tarea;
use App\Entregable;
use App\Historial;

class TareaController extends Controller
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
    	return view('tarea.index',compact('tareas'));
    }

    public function create()
    {
        $proyecto = Proyecto::where('estudiante_id',"=",auth()->user()->id)->get();
    	$hitos = Hito::where('proyecto_id',"=",$proyecto[0]['id'])->get();
        return view('tarea.create',compact('hitos'));
    }

    public function store(Request $request)
    {

    	//dd($request);
        $validator = Validator::make($request->all(), [
    		'nombre' => 'required|string|min:3|max:100',
            'comentario' => 'required|string|min:3|max:200'
        ]);

        if ($validator->fails()) 
        {
        	session()->flash('title', '¡Error!');
        	session()->flash('message', 'Existieron errores!');
        	session()->flash('icon', 'fa-check');
        	session()->flash('type', 'danger');
            return redirect('tarea/create')->withErrors($validator)->withInput();
        }
       
        Tarea::create([
            'nombre' => $request['nombre'],
            'fecha_limite' => $request['fecha_limite'],
            'comentario' => $request['comentario'] ,
            'hito_id' => $request['hito_id']
        ]);

        // creo algo en el historial
        $hito = Hito::find($request['hito_id']);
        Historial::create([
            'texto' => 'Creo la tarea '. $request['nombre'] .' en el hito '. $hito->nombre,
            'estudiante_id' => auth()->user()->id
        ]);


        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'La tarea se ha registrado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('/indexTarea');        
    }

    public function info(Tarea $tarea)
    {
        //dd($hito);
        //Buscar sus entregables
        $entregables = Entregable::where('tarea_id',"=",$tarea->id)->get();
        //mostrar sus datos
        return view('tarea.info',compact('tarea','entregables'));
    }

    public function delete(Tarea $tarea)
    {
        $entregables = Entregable::all();
 
        foreach ($entregables as $entregable) {
            if($entregable->tarea_id == $tarea->id)
            {
                $entregable->delete();
            }
        } 

        $hito = Hito::find($tarea->hito_id);
        Historial::create([
            'texto' => 'Elimino la tarea '. $tarea->nombre .' del hito '. $hito->nombre,
            'estudiante_id' => auth()->user()->id
        ]);
       
        $tarea->delete();

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'La tarea '. $tarea->nombre.' se ha eliminado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('/indexTarea'); 
    }

    public function edit(Tarea $tarea)
    {
        $proyecto = Proyecto::where('estudiante_id',"=",auth()->user()->id)->get();
        $hitos = Hito::where('proyecto_id',"=",$proyecto[0]['id'])->get();
        $fecha = Carbon::parse($tarea->fecha_limite);
        $tarea->fecha_limite = $fecha->format('Y-m-d');

        foreach ($hitos as $hito) {
            if($hito->id == $tarea->hito_id)
                $fecha = Carbon::parse($hito->fecha_inicio);
                $fechaT = Carbon::parse($hito->fecha_termino);
                $fecha_inicio = $fecha->format('d-m-Y');
                $fecha_termino = $fechaT->format('d-m-Y');
                $fecha2 = $fecha->format('Y-m-d');
                $fechaT2 = $fechaT->format('Y-m-d');
        }
        //dd($fechaT2);
        return view('tarea.edit', compact('hitos','tarea','fecha_inicio','fecha_termino','fecha2','fechaT2'));
    }
    
    public function update(Request $request, $id)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|min:3|max:100',
            'comentario' => 'required|string|min:3|max:200'
        ]);

        if ($validator->fails()) 
        {
            session()->flash('title', '¡Error!');
            session()->flash('message', 'Existieron errores!');
            session()->flash('icon', 'fa-check');
            session()->flash('type', 'danger');
            return redirect('tarea/create')->withErrors($validator)->withInput();
        }
       
        $tarea = Tarea::find($id);
        $tarea->update($request->except ('_token'));

        $hito = Hito::find($request['hito_id']);
        Historial::create([
            'texto' => 'Modifico la tarea '. $tarea->nombre .' en el hito '. $hito->nombre,
            'estudiante_id' => auth()->user()->id
        ]);

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'La tarea se ha editado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('/indexTarea');      
    } 

    public function fechas(Request $request)
    {
        $hito_id = $request['hito_id'];
        $hito = Hito::find($hito_id);
        $fecha_inicio = Carbon::parse($hito->fecha_inicio);
        $fecha_termino = Carbon::parse($hito->fecha_termino);
        $hito->fecha_inicio = $fecha_inicio->format('Y-m-d');
        $hito->fecha_termino = $fecha_termino->format('Y-m-d');

        $fechaI = $fecha_inicio->format('d-m-Y');
        $fechaT = $fecha_termino->format('d-m-Y');
        return response()->json(array('fecha_inicio' => $hito->fecha_inicio,'fecha_termino' => $hito->fecha_termino,'fechaI' => $fechaI ,'fechaT' => $fechaT));
    }

}
