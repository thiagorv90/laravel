<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representante_suplente extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'cdRepSup';
    public function empresa()
    {
        return $this->hasOne('App\Models\Empresa');
    }


    public function telefone()
    {
        return $this->hasMany('App\Models\Telefone_representante_suplente');
    }
    public function representacoes()
    {
        return $this->hasMany('App\Models\Representacoes');
    }

    public function usuario()
    {
        return $this->hasMany('App\Models\Users');
    }
}
