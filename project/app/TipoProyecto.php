<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProyecto extends Model
{
    protected $fillable = ['tipo'];

    public function nombre()
    {
        return ucfirst($this->tipo);
    }
}
