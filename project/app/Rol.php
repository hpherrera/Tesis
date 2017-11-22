<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $fillable = ['nombre'];

    public function users()
    {
    	return $this->hasMany('App\User');
    }

    public function nombre()
    {
        return ucfirst($this->nombre);
    }
}
