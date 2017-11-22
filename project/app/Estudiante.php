<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $fillable = ['nombre','persona_id'];

    public function matricula()
    {
        return ucfirst($this->matricula);
    }

    public function persona()
    {
        return $this->hasOne('App\Persona', 'id', 'id');
    }
}

