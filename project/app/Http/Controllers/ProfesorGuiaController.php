<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\Persona;
use App\Estudiante;

class ProfesorGuiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$proyectos = Proyecto::where('profesorGuia_id',"=",auth()->user()->id)->get();

    	return view('profesorguia.index',compact('proyectos'));
    }

    public function estudiantes()
    {
    	$proyectos = Proyecto::where('profesorGuia_id',"=",auth()->user()->id)->get();
    	$estudiantes = array();

    	foreach ($proyectos as $proyecto) {
    		$persona = Estudiante::where('persona_id',"=",$proyecto->estudiante_id)->get();
    		array_push($estudiantes,$persona);
    	}

    	//dd($estudiantes);
    	return view('profesorguia.estudiantes',compact('proyectos'));
    }
}
