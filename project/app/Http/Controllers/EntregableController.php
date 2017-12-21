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

    	//dd($request);
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
        Entregable::create([
            'nombre' => $request['nombre'],
            'fecha' => $carbon->now(),
            'tarea_id' => $request['tarea_id'] ,
            'estadoEntregable_id' => 5
        ]);

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El entregable se ha registrado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');
        
        return redirect()->action(
                'TareaController@info', ['tarea' => $request->tarea_id]
        );
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
        $entregable_nombre = $entregable->nombre;
        $entregable->delete();

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El entregable '. $entregable_nombre.' se ha eliminado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('/indexEntregable'); 
    }
}
