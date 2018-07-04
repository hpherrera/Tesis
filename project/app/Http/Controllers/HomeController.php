<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\Persona;
use App\Proyecto;
use App\Hito;
use App\ProfesorCurso;
use App\Notificacion;
use App\Tarea;
use App\Entregable;

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

        if($user->login == 0)
        {
            return view('changepass',compact('user'));
        }

        if($user->roles->count() > 1 && $user->rol_id == 0 && $user->login == 1)
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
            //ver cantidad de tareas con entregable
            $estados = array();
            $count = 0;
            $hitos = Hito::where('proyecto_id',"=",$proyecto->id)->get();
            //dd($hitos);
            foreach ($hitos as $hito) {

                $tareas = Tarea::where('hito_id',"=",$hito->id)->get();
                foreach ($tareas as $tarea) {
                    $entregables = Entregable::where('tarea_id',"".$tarea->id)->get();
                    if(sizeof($entregables) > 0)
                    {
                        $count++;
                    }
                }

                //calculo
                $total = 0;
                $count_Tareas = sizeof($tareas);
                if($count_Tareas){
                    $total = ($count*100)/$count_Tareas;
                }

                $hito_modificado = Hito::find($hito->id);
                $hito->progreso = $total;
                $hito->save();


                $count = 0;
            }
            //dd($estados);
            return view('estudiante.index', compact('proyecto','estados'));
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
            //dd($curso);
            $proyectos = Proyecto::where('estado_id',$curso[0]['curso_id'])->get();
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

    public function changepass(Request $request)
    {
        //dd($request);

        if($request['password1'] == $request['password2'])
        {
            $user = User::find($request['user_id']);
            $user->login = 1;
            $user->password = bcrypt($request['password2']);
            $user->save();

            return redirect('/');

        }
        else
        {
            session()->flash('title', '¡Error!');
            session()->flash('message', 'Las contraseñas no coinciden!');
            session()->flash('icon', 'fa-check');
            session()->flash('type', 'danger');

            return back();
        }
    }
}
