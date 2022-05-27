<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone_representante_suplente extends Model
{
    protected $primaryKey = 'cdTelefone';
    use HasFactory;
    public $timestamps = false;
    public function Telefone_representante_suplente(){
        return $this->hasOne('App\Models\Telefone_representante_suplente');
    }
}
