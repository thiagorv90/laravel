<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representacoe extends Model
{
    protected $primaryKey = 'cdRepresentacao';
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;
    protected $dates = ['dtInicioVigencia','dtFimVigencia'];
  
    protected $casts = [
        'items' => 'array'
    ];

    public function agenda()
    {
        return $this->hasMany('App\Models\Agenda');
    }

    public function representante()
    {
        return $this->hasMany('App\Models\Representacao_representante', 'id', 'cdTitular');
    }

    public function suplente()
    {
        return $this->hasOne('App\Models\Representante_suplente', 'id', 'cdSuplente');
    }

    public function instancia()
    {
        return $this->hasOne('App\Models\Instancia');
    }
}
