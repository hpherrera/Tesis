<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiante;
use App\User;
use App\Proyecto;
use App\Hito;

class EstudianteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$proyecto = Proyecto::where('estudiante_id',"=",auth()->user()->id)->get();
    	//dd($proyecto);
    	$hitos = Hito::where('proyecto_id',"=",$proyecto[0]['id'])->get();
    	//dd($hitos);
    	return view('estudiante.index',compact('proyecto','hitos'));
    }
}
