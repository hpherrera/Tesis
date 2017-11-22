<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Persona;
use App\Rol;
use App\TipoInvitado;
use App\User;
use App\Estudiante;
use App\Invitado;

class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$personas = Persona::all();

    	return view('persona.index',compact('personas'));
    }

    public function create()
    {
        $roles = Rol::all();
        $tipos = TipoInvitado::all();
        return view('persona.create', compact('roles','tipos'));
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

        User::create([
            'email' => $request['email'],
            'password' => bcrypt(123456),
            'rol_id' => $request['rol_id']
        ]);

        //ENVIAR CORREO DE CREACION DE CUENTA

        $id = Persona::create([
            'nombres' => $request['nombre'],
            'apellidos' => $request['apellidos'],
            'email' => $request['email']
        ]);

        if($request['rol_id'] == 5)
        {
            $validator = Validator::make($request->all(), [
                //'matricula' => 'required|numeric|10',
            ]); 

            //dd($id);
            Estudiante::create([
                'nombre' => $request['matricula'],
                'persona_id' =>(int)$id['id']
            ]);

        }

        if($request['rol_id'] == 6)
        {
            $validator = Validator::make($request->all(), [
                //'matricula' => 'required|numeric|10',
            ]); 

            if($request['tipo_id'] == 1)
            {
                Invitado::create([
                    'nombre' => $request['carrera'],
                    'persona_id' =>(int)$id['id']
                ]);
            }

            if($request['tipo_id'] == 2)
            {
                Invitado::create([
                    'nombre' => $request['empresa'],
                    'persona_id' =>(int)$id['id']
                ]);
            }

        }
        
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El usuario se ha registrado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return redirect('/');        
    }

}
