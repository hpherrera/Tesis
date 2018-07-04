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

        return view('Funcionario.estudents',compact('personas'));
    }

    public function stadistic()
    {
        return view('Funcionario.stadistic');
    }
}
