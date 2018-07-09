<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\TipoProyecto;
use App\EstadoProyecto;
use App\Estudiante;
use App\Area;
use App\Persona;
use App\User;
use App\Hito;
use App\Year;
use App\Entregable;
use App\Tarea;


class FuncionarioController extends Controller
{
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
        $years = Year::all();
        $tipos = TipoProyecto::all();
        $estados = EstadoProyecto::all();
        $areas = Area::all();

        //dd($personas);
        return view('Funcionario.createoldproyect', compact('personas','tipos','estados','areas','years'));
    }

    public function all_students()
    {
    	$personas = array();
        $estudiantes = Estudiante::all();
        foreach ($estudiantes as $estudiante) {
            $persona = Persona::find($estudiante->persona_id);
            array_push($personas, $persona);
        }
        $proyectos = Proyecto::all();
        return view('Funcionario.estudents',compact('personas','proyectos'));
    }

    public function stadistic()
    {
        return view('Funcionario.stadistic');
    }

    public function proyectoinfo(Proyecto $proyecto)
    {

        $estudiante = Persona::where('id',"=",$proyecto->estudiante_id)->first();
        //buscar documento final
        //dd($estudiante);
        $hitos = Hito::where('proyecto_id',"=",$proyecto->id)->get();
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
        

        $entregables = array();
        $entregables_todos = Entregable::all();
        foreach ($entregables_todos as $entregable) {
            foreach ($tareas as $tarea) {
                if($entregable->tarea_id == $tarea->id && $entregable->subidoPor == 5)
                {
                    array_push($entregables,$entregable); 
                }
            }
           
        }

        $documentofinal = collect($entregables)->last();
        return view('estudiante.informacionproyecto',compact('estudiante','proyecto','documentofinal'));
    }
}
