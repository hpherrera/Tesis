<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Persona;
use App\Proyecto;
use App\Hito;
use App\ProfesorCurso;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();

        if($user->roles->count() > 1 && $user->rol_id == 0)
        {
            return view('pickrole', compact('user'));
        }

        else if($user->Administrador())
        {
            $personas = Persona::All();

            return view('persona.index', compact('personas'));
        }
        else if($user->Estudiante())
        {
            $proyecto = Proyecto::where('estudiante_id', $user->id)->first();
            return view('estudiante.index', compact('proyecto'));
        }
        else if($user->Funcionario())
        {
            $proyectos = Proyecto::All();
            return view('funcionario.index',compact('proyectos'));
        }
        else if($user->ProfesorGuia())
        {
            $proyectos = Proyecto::where('profesorguia_id', $user->id)->get();
            return view('profesorguia.index', compact('proyectos'));
        }
        else if($user->profesorCurso())
        {
            $curso = ProfesorCurso::where('profesor_id', $user->id)->get();
            //dd($curso); supngamos que es 1
            $proyectos = Proyecto::where('estado_id',1)->get();
            //dd($proyectos);
            return view('profesorcurso.index',compact('proyectos'));
        }
        else
        {
            return view();
        }
    }

    public function pick()
    {
        $user = \Auth::user();

        if($user->roles->count() > 1)
        {
            return View('pickrole', compact('user'));
        }
        else
        {
            return redirect('/');
        }
    }

    public function pickRole(Request $request)
    {
        $rol = $request['rol'];

        $user = User::find($request['user']);
        $user->rol_id = $rol;
        $user->save();

        return redirect('/');
    }
}
