<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $primaryKey = 'cdEmpresa';

    use HasFactory;
    public $timestamps = false;

    public function Representante_suplente()
    {
        return $this->hasMany('App\Models\Representante_suplente');
    }
}
