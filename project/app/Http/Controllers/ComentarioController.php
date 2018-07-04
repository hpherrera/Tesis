<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comentario;
use App\User;
use App\Persona;

class ComentarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
    	//dd($request);
    	$persona = Persona::where('email',"=",auth()->user()->email)->get();
        $nombre_persona = $persona[0]['nombres']." ".$persona[0]['apellidos'];

    	$comentario = Comentario::create([
            'texto' => $request['comentarionuevo'],
            'entregable_id' => $request['entregablePadre'],
            'user_id' => auth()->user()->id,
            'user_name' => $nombre_persona
        ]);

    	session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El comentario se ha agregado exitosamente');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return back();
    }

    public function edit(Request $request,$id)
    {
    	//dd($request);
		$comentario = Comentario::find($id);
		$comentario->texto = $request['comentarioEdit'];

		$comentario->save();

        session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El comnetario se ha modificado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return back();
        
    }

    public function delete(Comentario $comentario)
    {
    	//dd($comentario);
    	$comentario->delete();

    	session()->flash('title', '¡Éxito!');
        session()->flash('message', 'El comentario se ha eliminado exitosamente!');
        session()->flash('icon', 'fa-check');
        session()->flash('type', 'success');

        return back();
    }

}
