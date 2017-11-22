<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = ['titulo', 'alumno_id','tipo_id', 'estado_id','progreso','area_id','profesorGuia_id'];

    public function estado()
    {
    	return $this->belongsTo('App\EstadoProyecto', 'estado_id', 'id');
    }

    public function tipo()
    {
    	return $this->belongsTo('App\TipoProyecto', 'tipo_id', 'id');
    }

    public function persona()
    {
    	return $this->belongsTo('App\Persona', 'alumno_id', 'id');
    }

    public function area()
    {
    	return $this->belongsTo('App\Area', 'area_id', 'id');
    }
}