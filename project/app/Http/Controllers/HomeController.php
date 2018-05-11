<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Persona;
use App\Proyecto;

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
            return view('home');
        }
        else if($user->Funcionario())
        {
            //return view('');
        }
        else if($user->ProfesorGuia())
        {
            $proyectos = Proyecto::where('profesorguia_id', $user->id);

            return view('profesorguia.index', compact('proyectos'));
        }
        else if($user->profesorCurso())
        {
            //return view('');
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
