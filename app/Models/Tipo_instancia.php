<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_instancia extends Model
{
    protected $primaryKey = 'cdTipoInstancia';
    use HasFactory;
    public $timestamps = false;

    public function Instituicoe()
    {
        return $this->hasMany('App\Models\Instituicoe');
    }
}
