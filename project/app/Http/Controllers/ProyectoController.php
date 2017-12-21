<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Proyecto;
use App\TipoProyecto;
use App\EstadoProyecto;
use App\Estudiante;
use App\Area;
use App\Persona;
use App\User;
use App\Hito;

class ProyectoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$proyectos = Proyecto::all();

    	return view('proyecto.index',compact('proyectos'));
    }

    public function create()
    {
    	$personas = array();
        $estudiantes = Estudiante::all();
        foreach ($estudiantes as $estudiante) {
            if($estudiante->ocupado == 0)
            {
                $persona = User::find($estudiante->persona_id);
                array_push($personas, $persona);
            }
        }
 
        $tipos = TipoProyecto::all();
        $estados = EstadoProyecto::all();
        $areas = Area::all();

        //dd($personas);
        return view('proyecto.create', compact('personas','tipos','estados','areas'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|min:3|max:100',
            'estudiante_id' => 'required|numeric',
            'tipo_id' => 'required|numeric',
            'estado_id' => 'required|numeric',
            'area_id' => 'required|numeric'
        ]);

        //dd($request);

        if ($validator->fails()) 
        {
        	session()->flash('title', '¡Error!');
        	session()->flash('message', 'Existieron errores!');
        	session()->flash('icon', 'fa-check');
        	session()->flash('type', 'danger');
            return redirect('proyecto/create')->withErrors($validator)->withInput();
        }

        Proyecto::create([
            'titulo' => $request['titulo'],
            'estudiante_id' => $request['estudiante_id'],
            'tipo_id' => $request['tipo_id'],
            'estado_id' => $request['estado_id'],
            'progreso' => 0,
            'area_id' => $request['area_id'],
            'profesorGuia_id' => auth()->user()->id
        ]);


        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El proyecto se ha registrado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('/profesorguia/index');        
    }

    public function edit(Proyecto $proyecto)
    {
    	$estudiantes = User::where('rol_id',"=",5)->get();
        $tipos = TipoProyecto::all();
        $estados = EstadoProyecto::all();
        $areas = Area::all();

        return view('proyecto.edit', compact('proyecto','estudiantes','tipos','estados','areas'));
    }

    public function update(Request $request, $id)
    {
       //dd($request);
       $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|min:3|max:100',
            'tipo_id' => 'required|numeric',
            'estado_id' => 'required|numeric',
            'area_id' => 'required|numeric',
            'estudiante_id' => 'required|numeric'
        ]);


        if ($validator->fails()) 
        {
        	session()->flash('title', '¡Éxito!');
        	session()->flash('message', 'Existieron errores!');
        	session()->flash('icon', 'fa-check');
        	session()->flash('type', 'danger');
            return redirect('proyecto/edit')->withErrors($validator)->withInput();
        }


  
        $proyecto = Proyecto::find($id);
        $proyecto->update($request->except ('_token'));

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El proyecto se ha modificado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('/index');
    }

    public function delete(Proyecto $proyecto)
    {
        $proyecto->delete();

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El proyectp se ha eliminado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('/profesorguia/index'); 
    }

    public function info(Proyecto $proyecto)
    {
        $hitos = Hito::where('proyecto_id',"=",$proyecto->id)->get();
        return view('proyecto.info',compact('hitos','proyecto')); 
    }


}
