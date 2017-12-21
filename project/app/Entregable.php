<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entregable extends Model
{
    protected $fillable = ['nombre', 'fecha','tarea_id','estadoEntregable_id'];

    public function tarea()
    {
    	return $this->belongsTo('App\Tarea', 'tarea_id', 'id');
    }

    public function estado()
    {
    	return $this->belongsTo('App\EstadoEntregable', 'estadoEntregable_id', 'id');
    }
}
