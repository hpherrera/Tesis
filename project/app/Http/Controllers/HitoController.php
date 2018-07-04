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

class HitoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$proyecto = Proyecto::where('estudiante_id',"=",auth()->user()->id)->get();
    	$hitos = Hito::where('proyecto_id',"=",$proyecto[0]['id'])->get();

    	return view('hito.index',compact('hitos'));
    }

    public function create()
    {
        return view('hito.create');
    }

    public function store(Request $request)
    {

    	//dd($request);
        $validator = Validator::make($request->all(), [
    		'nombre' => 'required|string|min:3|max:100'
        ]);

        if ($validator->fails()) 
        {
        	session()->flash('title', '¡Error!');
        	session()->flash('message', 'Existieron errores!');
        	session()->flash('icon', 'fa-check');
        	session()->flash('type', 'danger');
            return redirect('hito/create')->withErrors($validator)->withInput();
        }

        $proyecto = Proyecto::where('estudiante_id',"=",auth()->user()->id)->get();
       
        Hito::create([
            'nombre' => $request['nombre'],
            'fecha_inicio' => $request['fecha_inicio'],
            'fecha_termino' => $request['fecha_termino'],
            'proyecto_id' => $proyecto[0]['id'],
            'progreso' => 0
        ]);


        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El hito se ha registrado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        // creo algo en el historial
        Historial::create([
            'texto' => 'Creo el hito '. $request['nombre'],
            'estudiante_id' => auth()->user()->id
        ]);


        return redirect('/');        
    }

    public function edit(Hito $hito)
    {
        //dd($hito);
        $fecha_inicio = Carbon::parse($hito->fecha_inicio);
        $fecha_termino = Carbon::parse($hito->fecha_termino);
        $hito->fecha_inicio = $fecha_inicio->format('m/d/Y');
        $hito->fecha_termino = $fecha_termino->format('m/d/Y');        
        //dd($hito);
        return view('hito.edit', compact('hito'));
    }
    
    public function update(Request $request, $id)
    {
        //dd($request);
        // Solo puedo modificar el nombre y las fechas
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|min:3|max:100'
        ]);

        if ($validator->fails()) 
        {
            session()->flash('title', '¡Error!');
            session()->flash('message', 'Existieron errores!');
            session()->flash('icon', 'fa-check');
            session()->flash('type', 'danger');
            return redirect('hito/create')->withErrors($validator)->withInput();
        }
       
        $hito = hito::find($id);
        $hito->update($request->except ('_token'));

        // creo algo en el historial
        Historial::create([
            'texto' => 'Modifico el hito '. $hito->nombre,
            'estudiante_id' => auth()->user()->id
        ]);

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El hito se ha editado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('/indexHito');        
    } 

    public function info(Hito $hito)
    {
        //dd($hito);
        //Buscar sus tareas
        $tareas = Tarea::where('hito_id',"=",$hito->id)->get();
        //mostrar sus datos
        return view('hito.info',compact('hito','tareas'));
    }

    public function delete(Hito $hito)
    {
        $nombre_hito = $hito->nombre;
        $tareas = Tarea::all();
        $entregables = Entregable::all();
        foreach ($tareas as $tarea) {
            if($tarea->hito_id == $hito->id)
            {
                foreach ($entregables as $entregable) {
                    if($entregable->tarea_id == $tarea->id)
                    {
                        $entregable->delete();
                    }
                } 
                $tarea->delete();
            }
        }

        // creo algo en el historial
        Historial::create([
            'texto' => 'Elimino el hito '. $hito->nombre,
            'estudiante_id' => auth()->user()->id
        ]);

        $hito->delete();
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El Hito'. $hito->nombre.' se ha eliminado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('/indexHito'); 
    }

}
