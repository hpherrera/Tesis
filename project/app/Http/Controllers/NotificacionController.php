<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notificacion;

class NotificacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	
        $notifications = Notificacion::where('email',"=",auth()->user()->email)->get();

    	return view('notificacion.index', compact('notifications'));
    }

    public function update(Request $request)
    {
    	$notification = Notificacion::find($request->notification_id);
    	$notification->leido= 1;
    	$notification->save();

     	return response()->json(array('info' => $notification->texto));
    }

    public function view(Request $request)
    {
    	$notification = Notificacion::find($request->notification_id);
    	$notification->leido = 1;
    	$notification->save();

     	return response()->json(array('true' => true));
    }

    public function isAcepted()
    {
        $session_email =  auth()->user()->email ;
        $notis = Notificacion::all();
        $notifications = array();

        foreach ($notis as $notification) {
            if($notification->email == $session_email && $notification->leido == 0)
            {
                array_push($notifications,$notification);   
            }
        }
        //dd($notifications);
        $size = sizeof($notifications);
        $returnHTML = view('partials.listnotifications')->with('Notifications',$notifications)->render();
        return response()->json(array('success'=>true, 'html'=>$returnHTML,'size'=>$size));
        //return response()->json(array('Notifications'=>$notifications));
        
    }
}
