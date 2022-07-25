<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instancia extends Model
{
    protected $primaryKey = 'cdInstancia';
    use HasFactory;
    public $timestamps = false;

    public function Contato()
    {
        return $this->hasMany('App\Models\Contato');
    }
    protected $guarded = [];
    public function instituicoes()
    {
        return $this->hasOne('App\Models\Instituicoe');
    }

    public function temarepresentacoes()
    {
        return $this->hasOne('App\Models\Tema_representacoe');
    }

    public function representacoe()
    {
        return $this->hasMany('App\Models\Representacoe');
    }
}
