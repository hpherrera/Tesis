<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiante;
use App\User;
use App\Proyecto;
use App\Hito;
use App\Historial;

class EstudianteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function historial(Estudiante $estudiante)
    {
        $historials = Historial::where('estudiante_id',$estudiante->id);
        dd($historials);
        //enviar la tabla historial completa
        return view('estudiante.historial',compact('historials'));
    }

    public function planification()
    {

    }
}
