<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hito extends Model
{
    protected $fillable = ['nombre', 'fecha_inicio', 'fecha_termino','proyecto_id'];

    public function proyecto()
    {
    	return $this->belongsTo('App\Proyecto', 'proyecto_id', 'id');
    }

    public function nombre()
    {
        return ucfirst($this->nombre);
    }
}
