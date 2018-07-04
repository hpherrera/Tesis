<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Persona;
use App\Rol;
use App\TipoInvitado;
use App\User;
use App\Estudiante;
use App\Invitado;
use App\Mail\CrearCuenta;
use App\Curso;
use App\ProfesorCurso;

class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$personas = Persona::all();
        //dd($personas);
    	return view('persona.index',compact('personas'));
    }

    public function create2()
    {
        return view('estudiante.create');
    }

    public function create()
    {
        $roles = Rol::all();
        $tipos = TipoInvitado::all();
        $cursos = Curso::All();

        return view('persona.create', compact('roles','tipos','cursos'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|min:3|max:100',
            'apellidos' => 'required|string|min:3|max:100',
            'email' => 'required|string|email|max:255|unique:users',
        ]);


        if ($validator->fails()) 
        {
        	session()->flash('title', '¡Error!');
        	session()->flash('message', 'Existieron errores!');
        	session()->flash('icon', 'fa-check');
        	session()->flash('type', 'danger');
            return redirect('/create')->withErrors($validator)->withInput();
        }

        $roles = $request['rol_id'];
        //dd($roles[0]);
        if(sizeof($roles) == 1)
        {
            $rolunico = (int)$roles[0];
        }
        else{
            $rolunico = 0;
        }

        //genero password
        $longitud = 8;
        $pass = substr(MD5(rand(5, 100)), 0, $longitud);

        $iduser = User::create([
            'email' => $request['email'],
            'password' => bcrypt($pass),// Generar aleatoriamente una password
            'rol_id' => $rolunico,
            'login' => 0
        ]);


        $id = Persona::create([
            'nombres' => $request['nombre'],
            'apellidos' => $request['apellidos'],
            'email' => $request['email']
        ]);

        foreach ($roles as $rol ) {
            /* Guardar los roles en la base de datos con user_roles*/

            $user_rol = Rol::find($rol);
            $user_rol->users()->attach((int)$iduser['id']);

            if($rol == 4)
            {
                ProfesorCurso::create([
                    'curso_id' => $request['curso_id'],
                    'profesor_id'=>(int)$id['id']
                ]);

            }

            if($rol == 5)
            {
                Estudiante::create([
                    'nombre' => $request['matricula'],
                    'persona_id' =>(int)$id['id'],
                    'ocupado' => 0
                ]);

            }

            if($rol == 6)
            {

                if($request['tipo_id'] == 1)
                {
                    Invitado::create([
                        'nombre' => $request['carrera'],
                        'persona_id' =>(int)$id['id'],
                        'tipo' => 1
                    ]);
                }

                if($request['tipo_id'] == 2)
                {
                    Invitado::create([
                        'nombre' => $request['empresa'],
                        'persona_id' =>(int)$id['id'],
                        'tipo' => 2
                    ]);
                }

                if($request['tipo_id'] == 3)
                {
                    Invitado::create([
                        'nombre' => "OTRO",
                        'persona_id' =>(int)$id['id'],
                        'tipo' => 3
                    ]);
                }

            }
        }

        //ENVIAR CORREO DE CREACION DE CUENTA
        //$passwordIngreso = 123456;
        Mail::to($request['email'])->send(new CrearCuenta($iduser,$pass));
        
        
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El usuario se ha registrado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        if($request['profesor'] == 1)
        {
            return redirect('/profesorguia/estudiantes');
        }
        elseif ($request['profesor'] == 2)
        {
            return redirect('/home');
        }
        else
        {
            return redirect('/index');        
        }
        
    }

    public function edit(Persona $persona)
    {
        $roles = Rol::all();
        $user = User::where('email',"=",$persona->email)->get();
        $tipos = TipoInvitado::all();
        $cursos = Curso::All();

        //dd($user);
        $tipoInvitado = -1;
        if($user[0]['rol_id'] == 4)
        {
            $curso = ProfesorCurso::where('profesor_id',"=",$persona->id)->get();
            $curso_id = Curso::find($curso[0]['curso_id']);
            //dd($curso_id);
            return view('persona.edit', compact('persona','roles','tipos','tipoInvitado','curso_id','cursos'));
        }

        if($user[0]['rol_id'] == 5)
        {
            //dd($persona->id);
            $estudiante = Estudiante::where('persona_id',"=",$persona->id)->get();
            //dd($estudiante);
            $matricula = $estudiante[0]['nombre'];
            //dd($matricula);
            $tipoInvitado = -1;
            return view('persona.edit', compact('persona','roles','tipos','matricula','tipoInvitado','cursos'));
    
        }

        if($user[0]['rol_id'] == 6)
        {
            $invitado = Invitado::where('persona_id',"=",$persona->id)->get();
            $tipoInvitado = $invitado[0]['tipo'];
            $nombreInvitado = $invitado[0]['nombre'];
            //dd($nombreInvitado);
            return view('persona.edit', compact('persona','roles','tipos','tipoInvitado','nombreInvitado','cursos'));
    
        }
        
        return view('persona.edit', compact('persona','roles','tipos','tipoInvitado','cursos'));
    }

    public function update(Request $request , $email)
    {
        //dd($request);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|min:3|max:100',
            'apellidos' => 'required|string|min:3|max:100',
            'email' => 'required|string|email|max:255|',
        ]);


        if ($validator->fails()) 
        {
            session()->flash('title', '¡Error!');
            session()->flash('message', 'Existieron errores!');
            session()->flash('icon', 'fa-check');
            session()->flash('type', 'danger');
            return redirect('/create')->withErrors($validator)->withInput();
        }

        $roles = $request['rol_id'];

        $user = User::find($email);

        $persona = Persona::where('email',"=",$email)->get();
        $persona[0]['nombres'] = $request['nombre'];
        $persona[0]['apellidos']= $request['apellidos'];
        $persona[0]->save();

       
        
        foreach ($roles as $rol ) {
            /* Modificar los roles en la base de datos con user_roles
            $user_rol = Rol::find($rol);
            $user_rol->users()->attach($user->id);*/

            if($rol == 4)
            {
                
                $profesor = ProfesorCurso::where('profesor_id',"=",$persona[0]['id'])->get();
                $profesor[0]['curso_id'] = $request['curso_id'];
                $profesor[0]->save();
            }

            if($rol == 5)
            {
                $estudiante = Estudiante::where('persona_id',"=",$persona[0]['id'])->get();
                $estudiante[0]['nombre'] = $request['matricula'];
                $estudiante[0]->save();
            }

            if($rol == 6)
            {

                //dd($request);
                if($request['tipo_id'] == 1)
                {
                    $invitado = Invitado::where('persona_id',"=",$persona[0]['id'])->get();   
                    $invitado[0]['nombre'] = $request['carrera'];
                    $invitado[0]['tipo'] = 1;
                    $invitado[0]->save();
                }

                if($request['tipo_id'] == 2)
                {
                    $invitado = Invitado::where('persona_id',"=",$persona[0]['id'])->get();
                    $invitado[0]['nombre'] = $request['empresa'];
                    $invitado[0]['tipo'] = 2;
                    $invitado[0]->save();
                }

                if($request['tipo_id'] == 3)
                {
                    $invitado = Invitado::where('persona_id',"=",$persona[0]['id'])->get();
                    $invitado[0]['nombre'] = "OTRO";
                    $invitado[0]['tipo'] = 3;
                    $invitado[0]->save();
                }

            }
        }

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El usuario se ha modificado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('/index');  
    }

    public function delete(Persona $persona)
    {
        //dd($persona);
        $user = User::where('email',"=",$persona->email)->get();
        $persona->delete();
        $user[0]->delete();

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El usuario se ha eliminado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('/index'); 
    }

}
