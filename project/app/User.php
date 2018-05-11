<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'email', 'password', 'rol_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function roles()
    {
        return $this->belongsToMany('App\Rol', 'user_rols');
    }

    public function persona()
    {
        return $this->hasOne('App\Persona', 'id', 'id');
    }

    public function Administrador()
    {
        if($this->rol_id == 1)
        {
            return true;
        }

        return false;
    }

    public function Funcionario()
    {
        if($this->rol_id == 2)
        {
            return true;
        }

        return false;
    }
    public function ProfesorGuia()
    {
        if($this->rol_id == 3)
        {
            return true;
        }

        return false;
    }
    public function ProfesorCurso()
    {
        if($this->rol_id == 4)
        {
            return true;
        }

        return false;
    }


    public function Estudiante()
    {
        if($this->rol_id == 5)
        {
            return true;
        }
        
        return false;
    }

    public function Invitado()
    {
        if($this->rol_id == 6)
        {
            return true;
        }

        return false;
    }
}
