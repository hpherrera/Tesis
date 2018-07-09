<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use App\Persona;
use App\Estudiante;
use App\Reunion;
use Carbon\Carbon;
use App\User;
use App\InvitadoProyecto;

class ProfesorGuiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$proyectos = Proyecto::where('profesorGuia_id',"=",auth()->user()->id)->get();
        $usuarios= User::all();
        $invitados = array();
        foreach ($usuarios as $user) {
            if($user->roles->contains('id', 6))
            {
                array_push($invitados, $user);
            }
        }
        
        dd($proyectos);
    	return view('profesorguia.index',compact('proyectos','invitados'));
    }

    public function estudiantes()
    {
    	$proyectos = Proyecto::where('profesorGuia_id',"=",auth()->user()->id)->get();
    	$estudiantes = array();

    	foreach ($proyectos as $proyecto) {
            if($proyecto->estudiante_id != 0)
            {
                $persona = Estudiante::where('persona_id',"=",$proyecto->estudiante_id)->get();
                array_push($estudiantes,$persona);
            }
    		
    	}

        //dd($estudiantes);
    	return view('profesorguia.estudiantes',compact('proyectos'));
    }

    public function planificacion()
    {
        $proyectos = Proyecto::where('profesorGuia_id',"=",auth()->user()->id)->get();
        $personas = array();

        foreach ($proyectos as $proyecto) {
            if($proyecto->estudiante_id != 0)
            {
                $persona = Persona::find($proyecto->estudiante_id);
                array_push($personas,$persona);
            }
            
        }
        //dd($personas);
        // Cargar los estudiantes de los cuales el profesor es guia
        return view('profesorguia.planificacionreunion',compact('personas'));
    }

    public function createreunion(Request $request)
    {
        //dd($request);
        Reunion::create([
            'fecha' => $request['fecha'],
            'estudiante_id' => $request['estudiante_id'],
            'profesor_guia_id' => auth()->user()->id,
            'hora' => Carbon::parse($request['fecha'])->modify($request['hora'])
        ]);

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'La reunion se ha registrado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return back();
    }

    public function updatereunion(Request $request)
    {
        //dd($request);
        $reunion = Reunion::find($request['reunion_id']);
        $reunion->fecha = $request['fechaE'];
        $reunion->hora = Carbon::parse($request['fechaE'])->modify($request['horaE']);
        $reunion->estudiante_id = $request['estudiante_idE'];
        $reunion->save();
        
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'La reunion se ha modificado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return back();
    }

    public function show_reunion(Request $request)
    {
        $user = \Auth::user();
        $reuniones = Reunion::where('profesor_guia_id', $user->id)->get();
        $response =  array();
        foreach ($reuniones as $reunion)
        {
            $fecha= Carbon::parse($reunion->hora);
            $hora = $fecha->format('H:i');
            $object = array(
                'id' =>$reunion->id,
                'title' =>'Reunion a las '.$hora.' con '. $reunion->persona->nombres.' '.$reunion->persona->apellidos,
                'start' => $reunion->fecha,
                'description'=>'Reunión a las '.$hora .'hrs.'//$reunion->hora
            );
            array_push($response, $object);
        }
        return Response()->json($response);
    }

    public function editreunion(Request $request)
    {
        $reunion = Reunion::find($request['id']);
        $fecha = Carbon::parse($reunion->hora);
        $reunion->hora = $fecha->format('H:i');
        $fechar = Carbon::parse($reunion->fecha);
        $reunion->fecha = $fechar->format('Y-m-d');
        return $reunion;
    }

    public function reuniones_month(Request $request)
    {        
        $coutn_month = 0;
        $user = \Auth::user();

        $reuniones = Reunion::where('profesor_guia_id', $user->id)->get();

        $mytime = Carbon::now();
        $month = $mytime->format('m');
        $year = $mytime->format('Y');

        foreach ($reuniones as $reunion)
        {
            $lastDate = Carbon::parse($reunion->fecha);
            $lastDate_month= $lastDate->format('m');
            $lastDate_year= $lastDate->format('Y');
            if($lastDate_month == $month && $lastDate_year == $year)
            {
                $coutn_month++;
            }
            
        }
        
        return $coutn_month;
    }

    public function delete(Reunion $reunion)
    {
        $reunion->delete();

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'La reunión se ha eliminado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return back(); 
    }

    public function addInvitado(Request $request, Proyecto $proyecto)
    {
        //dd($request,$proyecto);

        $invitadoProyecto = InvitadoProyecto::create([
            'persona_id' => $request['invitado_id'],
            'proyecto_id' => $proyecto->id
        ]);

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'La asociación del proyecto con el invitado se ha agregado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return back(); 
    }

    public function updateInvitado(Request $request)
    {
        $invitado = InvitadoProyecto::where('proyecto_id',"=",$request['id'])->first();
        return $invitado;
    }

    public function editInvitado(Request $request)
    {
        //dd($request);
        $invitadoProyecto = InvitadoProyecto::where('proyecto_id',"=",$request['proyecto_id'])->first();
        $invitadoProyecto->persona_id = $request['invitado_id'];

        $invitadoProyecto->save();
        
        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'La asociación del proyecto con el invitado se ha modificado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return back();

    }

    public function removeInvitado(Proyecto $proyecto)
    {
        $invitadoProyecto = InvitadoProyecto::where('proyecto_id',"=",$proyecto->id)->first();
        $invitadoProyecto->delete();

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'La asociación del proyecto con el invitado se ha eliminado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return back(); 
    }

}
